<?php
// src/Controller/IsServicesController.php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\InfoService;
use App\Form\ChangeStatusServiceType;
use App\Repository\EmployeeRepository;
use App\Repository\InfoServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class IsServicesController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/service', name: 'app_is_services')]
    public function index(
        Security $security,
        EmployeeRepository $employeeRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $employee = $employeeRepository->findOneBy(['userName' => $security->getUser()->getUsername()]);

        $employees = $employeeRepository->findAll();

        // Calcul et formatage du temps de service total
        $tssInSeconds = $employee->getTss();
        $hours = floor($tssInSeconds / 3600);
        $minutes = floor(($tssInSeconds % 3600) / 60);
        $seconds = $tssInSeconds % 60;


        // Calcul du nombre de personnes en service
        $nbService = 0;
        foreach ($employees as $employeeItem) {
            if ($employeeItem->isService() === true) {
                $nbService++;
            }
        }

        $form = $this->createForm(ChangeStatusServiceType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employee = $form->getData();
            $entityManager->persist($employee);
            $entityManager->flush();
            $this->addFlash('success', 'Vos informations ont bien été enregistrées');
        }

        return $this->render('prive/pages/is_services/index.html.twig', [
            'form' => $form->createView(),
            'employee' => $employee,
            'employees' => $employees,
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $seconds,
            'nbService' => $nbService,
        ]);
    }


    #[IsGranted('ROLE_USER')]
    #[Route('/service/start', name: 'app_is_services_start')]
    public function start(
        Security $security,
        EmployeeRepository $employeeRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $employee = $employeeRepository->findOneBy(['userName' => $security->getUser()->getUsername()]);
        $employee->setService(true);
        $now = new \DateTime('now');
        $employee->setStartAt($now);

        $entityManager->persist($employee);
        $entityManager->flush();
        $this->addFlash('success', 'Vous êtes en service');

        return $this->redirectToRoute('app_is_services');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/service/stop', name: 'app_is_services_stop')]
    public function stop(
        Security $security,
        EmployeeRepository $employeeRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $employee = $employeeRepository->findOneBy(['userName' => $security->getUser()->getUsername()]);
        $employee->setService(false);
        $now = new \DateTime('now');
        $startAt = $employee->getStartAt();

        $interval = $now->diff($startAt);
        $tss = $employee->getTss() + $interval->s + $interval->i * 60 + $interval->h * 3600;
        $employee->setTss($tss);

        $entityManager->persist($employee);
        $entityManager->flush();
        $this->addFlash('danger', 'Vous n\'êtes plus en service');

        return $this->redirectToRoute('app_is_services');
    }

    #[Route('/service/transfert-tss-lasttss', name: 'app_transfert_tss_lasttss')]
    public function transfertTssLastTss(
        EmployeeRepository $employeeRepository,
        EntityManagerInterface $entityManager
    ): Response {
        // Récupération de tous les employés
        $employees = $employeeRepository->findAll();

        foreach ($employees as $employee) {
            // Vérifier si le temps de service (Tss) est défini
            if ($employee->getTss() !== null) {
                // Transférer Tss à LastTss et réinitialiser Tss à zéro
                $employee->setTotalTss($employee->getTotalTss() + $employee->getLastTss() + $employee->getTss());

                $employee->setLastTss($employee->getTss());
                $employee->setTss(0);

                // Enregistrer les modifications dans la base de données
                $entityManager->persist($employee);
            }
        }

        // Appliquer toutes les modifications à la base de données
        $entityManager->flush();

        return new Response('TSS has been transferred to LastTss and reset.');
    }
}
