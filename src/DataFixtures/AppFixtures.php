<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Employee;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setUsername('tabacbart');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'Am270391'));
        $manager->persist($user);

        $employee = new Employee();
        $employee->setName('Tabac');
        $employee->setFirstName('Bart');
        $employee->setGrade('Directeur');
        $employee->setPhone('0606060606');
        $employee->setAffiliation('LSMC');
        $employee->setUserName('tabacbart');
        $employee->setTss(0);
        $employee->setServices('Code 1');
        $employee->setLieu('Los Santos');
        $employee->setVehicule('Ambulance');
        $employee->setDetail('Détail');
        $employee->setService(false);
        $employee->setPss(true);
        $employee->setGos(true);
        $employee->setGss(true);
        $employee->setAms(true);
        $employee->setVms(true);
        $employee->setEmt(true);
        $employee->setDsi(true);
        $employee->setZd(true);
        $employee->setAmf(true);
        $employee->setFpc(true);
        $employee->setTechasg(true);
        $employee->setSf(true);
        $manager->persist($employee);

        $manager->flush();
    }
}
