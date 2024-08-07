<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employee;
use App\Form\ChangeMdpType;
use App\Form\ChangeProfileType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MonCompteController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/mon-compte', name: 'app_mon_compte')]
    public function index(): Response
    {
        return $this->render('prive/pages/mon_compte/index.html.twig', [
            'controller_name' => 'MonCompteController',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/changer-mot-de-passe', name: 'app_change_password')]
    public function changeMdp(
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security
    ): Response {
        $user = $security->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour changer votre mot de passe.');
        }

        $form = $this->createForm(ChangeMdpType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $plainPassword = $data['password'];
            $confirmPassword = $data['confirm_password'];

            if ($plainPassword === $confirmPassword) {
                $encodedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($encodedPassword);

                // Utiliser EntityManagerInterface pour persister les modifications
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Votre mot de passe a été mis à jour avec succès.');
                return $this->redirectToRoute('app_mon_compte');
            } else {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
            }
        }

        return $this->render('prive/pages/mon_compte/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/modifier-profil', name: 'app_change_profile')]
    public function changeProfile(
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
        EmployeeRepository $employeeRepository
    ): Response {
        $user = $employeeRepository->findOneBy(['userName' => $security->getUser()->getUsername()]);

        $form = $this->createForm(ChangeProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour avec succès.');

            return $this->redirectToRoute('app_mon_compte');
        }

        return $this->render('prive/pages/mon_compte/edit_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
