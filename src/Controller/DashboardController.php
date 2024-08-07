<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/Prise-de-Service', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('prive/pages/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
