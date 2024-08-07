<?php

namespace App\Controller;

use App\Entity\RecruitmentRequest;
use App\Form\RecruitmentRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruitmentRequestController extends AbstractController
{
    #[Route('/recrutement', name: 'app_recruitment_request')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        // Création d'une nouvelle instance de RecruitmentRequest
        $recruitmentRequest = new RecruitmentRequest();

        // Création du formulaire
        $form = $this->createForm(RecruitmentRequestType::class, $recruitmentRequest);

        // Gestion de la requête et traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruitmentRequest->setStatusRec(1);
            $manager->persist($recruitmentRequest);
            $manager->flush();

            // Ajout d'un message de succès
            $this->addFlash('success', 'Votre demande de recrutement a été envoyée.');

            // Redirection vers la même page pour éviter les soumissions répétées
            return $this->redirectToRoute('app_recruitment_request');
        }

        // Rendu de la vue avec le formulaire
        return $this->render('public/pages/recruitment_request/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
