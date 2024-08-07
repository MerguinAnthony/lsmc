<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employee;
use App\Entity\RecruitmentRequest;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RecrutementRecuController extends AbstractController
{
    #[Route('/recrutement/recu', name: 'app_recrutement_recu')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les candidatures
        $candidates = $entityManager->getRepository(RecruitmentRequest::class)->findAll();

        // Rendu de la vue avec les candidatures
        return $this->render('prive/pages/recrutement_recu/index.html.twig', [
            'candidates' => $candidates,
        ]);
    }

    #[Route('/recrutement/accept/{id}', name: 'app_recrutement_accept')]
    public function accept(
        EntityManagerInterface $entityManager,
        RecruitmentRequest $recruitmentRequest,
        UserPasswordHasherInterface $passwordHasher,
        HttpClientInterface $httpClient // Utilisez HttpClientInterface ici
    ): Response {
        // Accepter la candidature
        $recruitmentRequest->setStatusRec('2');

        // Créer un nouvel utilisateur
        $user = new User();
        $username = strtolower(str_replace(' ', '', $recruitmentRequest->getRpLastName() . $recruitmentRequest->getRpFirstName()));

        $encodedPassword = $passwordHasher->hashPassword($user, $username);

        $user->setUsername($username);
        $user->setPassword($encodedPassword);
        $user->setRoles(['ROLE_USER']);

        $entityManager->persist($user);
        $entityManager->flush();

        $employee = new Employee();
        $employee->setName($recruitmentRequest->getRpLastName());
        $employee->setFirstName($recruitmentRequest->getRpFirstName());
        $employee->setGrade('Ambulancier');
        $employee->setAgregation('Aucune');
        $employee->setUnite('Aucune');
        $employee->setPhone($recruitmentRequest->getRpPhone());
        $employee->setAffiliation('LSMC');
        $employee->setTss(0);
        $employee->setUserName($username);
        $employee->setServices('CODE 6');
        $employee->setLieu('Los Santos');
        $employee->setVehicule('Aucun');
        $employee->setDetail('Aucun');
        $employee->setService(false);
        $employee->setPss(false);
        $employee->setGos(false);
        $employee->setGss(false);
        $employee->setAms(false);
        $employee->setVms(false);
        $employee->setEmt(false);
        $employee->setDsi(false);
        $employee->setZd(false);
        $employee->setAmf(false);
        $employee->setFpc(false);
        $employee->setTechasg(false);
        $employee->setSf(false);
        $entityManager->persist($employee);
        $entityManager->remove($recruitmentRequest);

        $entityManager->flush();

        // Envoyer un message au salon Discord
        $webhookUrl = 'https://discord.com/api/webhooks/1269725335918870560/OZh8-Qqy6ITTeN-6ffyDBwF9ycf2Ca19bzNmgkfMlzRddO2XRtiywrBYozn6UhW4WbF_';

        $messageContent = [
            'content' => "La candidature de **{$recruitmentRequest->getRpFirstName()} {$recruitmentRequest->getRpLastName()}** a été acceptée ! 🎉",
            'embeds' => [
                [
                    'title' => 'Candidature Acceptée',
                    'description' => "Félicitations <@{$recruitmentRequest->getPseudoDiscord()}>! Vous avez été accepté(e) dans notre équipe. Veuillez ouvrir un ticket pour finaliser votre recrutement.",
                    'color' => 65280,
                    'thumbnail' => [
                        'url' => 'https://127.0.0.1:8000/assets/img/candidature_acceptee.png'
                    ],
                ]
            ]
        ];

        $httpClient->request('POST', $webhookUrl, [
            'json' => $messageContent,
        ]);

        return $this->redirectToRoute('app_recrutement_recu');
    }

    #[Route('/recrutement/delete/{id}', name: 'app_recrutement_delete')]
    public function delete(
        EntityManagerInterface $entityManager,
        RecruitmentRequest $recruitmentRequest,
        UserRepository $userRepository,
        HttpClientInterface $httpClient // Utilisez HttpClientInterface ici aussi
    ): Response {
        // Supprimer l'utilisateur associé
        $username = strtolower(str_replace(' ', '', $recruitmentRequest->getRpLastName() . $recruitmentRequest->getRpFirstName()));
        $user = $userRepository->findOneBy(['username' => $username]);

        if ($user) {
            $entityManager->remove($user);
        }

        // Supprimer la candidature
        $entityManager->remove($recruitmentRequest);
        $entityManager->flush();

        // Envoyer un message au salon Discord
        $webhookUrl = 'https://discord.com/api/webhooks/1269725335918870560/OZh8-Qqy6ITTeN-6ffyDBwF9ycf2Ca19bzNmgkfMlzRddO2XRtiywrBYozn6UhW4WbF_';

        $messageContent = [
            'content' => "La candidature de **{$recruitmentRequest->getRpFirstName()} {$recruitmentRequest->getRpLastName()}** a été refusée. <@{$recruitmentRequest->getPseudoDiscord()}> ❌",
            'embeds' => [
                [
                    'title' => 'Candidature Refusée',
                    'description' => "Nous avons le regret de vous informer que votre candidature a été refusée.",
                    'color' => 16711680, // Couleur rouge
                    'thumbnail' => [
                        'url' => 'https://example.com/assets/img/candidature_refusee.png' // Remplacez par l'URL de votre image hébergée publiquement
                    ],
                ]
            ]
        ];


        $httpClient->request('POST', $webhookUrl, [
            'json' => $messageContent,
        ]);

        return $this->redirectToRoute('app_recrutement_recu');
    }
}
