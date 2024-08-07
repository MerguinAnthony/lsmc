<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Form\NewEmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class GestEmployeeController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees', name: 'app_employee_index')]
    public function index(EmployeeRepository $employeeRepository): Response
    {
        // Récupération de tous les employés
        $employees = $employeeRepository->findAll();

        // Rendu de la vue avec la liste des employés
        return $this->render('prive/pages/gest_employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees/new', name: 'app_employee_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher,): Response
    {
        // Création d'un nouvel employé
        $employee = new Employee();

        // Création du formulaire
        $form = $this->createForm(NewEmployeeType::class, $employee);

        // Gestion de la requête POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee->setService(false);
            $employee->setStartAt(new \DateTime('now'));
            $employee->setTss(0);
            $employee->setServices('Code 6');
            $employee->setLieu('Los Santos');
            $employee->setVehicule('Aucun');

            // creation de l'user
            $user = new User();
            $user->setUsername($employee->getUserName());
            $user->setRoles(['ROLE_USER']);

            $username = $user->getUsername();
            $encodedPassword = $passwordHasher->hashPassword($user, $username);
            $user->setPassword($encodedPassword);
            $entityManager->persist($user);
            $entityManager->persist($employee);
            $entityManager->flush();

            // Redirection avec un message de succès
            $this->addFlash('success', 'L\'employé a été ajouté.');

            return $this->redirectToRoute('app_employee_index');
        }

        // Rendu de la vue avec le formulaire
        return $this->render('prive/pages/gest_employee/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees/{id}/edit', name: 'app_employee_edit')]
    public function edit(
        Employee $employee,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // Création du formulaire avec les données de l'employé
        $form = $this->createForm(EmployeeType::class, $employee);

        // Gestion de la requête POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde des modifications
            $entityManager->flush();

            // Redirection avec un message de succès
            $this->addFlash('success', 'Les informations de l\'employé ont été mises à jour.');

            return $this->redirectToRoute('app_employee_index');
        }

        // Rendu de la vue avec le formulaire et l'employé
        return $this->render('prive/pages/gest_employee/edit.html.twig', [
            'form' => $form->createView(),
            'employee' => $employee,
        ]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees/{id}/delete', name: 'app_employee_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Employee $employee,
        EntityManagerInterface $entityManager
    ): Response {
        // Vérification du token CSRF
        if ($this->isCsrfTokenValid('delete' . $employee->getId(), $request->request->get('_token'))) {
            // Suppression de l'employé
            $entityManager->remove($employee);
            $entityManager->flush();

            // Redirection avec un message de succès
            $this->addFlash('success', 'L\'employé a été licencié.');
        }

        return $this->redirectToRoute('app_employee_index');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees/{id}', name: 'app_employee_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        return $this->render('prive/pages/gest_employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees/retrait-service/{id}', name: 'app_employee_retrait_service', methods: ['GET'])]
    public function retraitService(Employee $employee, EntityManagerInterface $entityManager): Response
    {
        // Retrait du service
        $employee->setService(false);
        $entityManager->flush();

        // Redirection avec un message de succès
        $this->addFlash('success', 'L\'employé a été retiré du service.');

        return $this->redirectToRoute('app_employee_index');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/employees/ajout-service/{id}', name: 'app_employee_ajout_service', methods: ['GET'])]
    public function ajoutService(Employee $employee, EntityManagerInterface $entityManager): Response
    {
        // Ajout du service
        $now = new \DateTime('now');
        $employee->setStartAt($now);
        $employee->setService(true);
        $entityManager->flush();

        // Redirection avec un message de succès
        $this->addFlash('success', 'L\'employé a été ajouté au service.');

        return $this->redirectToRoute('app_employee_index');
    }
}
