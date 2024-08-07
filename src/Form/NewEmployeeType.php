<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class NewEmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control']
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control']
            ])
            ->add('Grade', TextType::class, [
                'label' => 'Grade',
                'attr' => ['class' => 'form-control']
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'form-control']
            ])
            ->add('affiliation', TextType::class, [
                'label' => 'Affiliation',
                'attr' => ['class' => 'form-control']
            ])
            ->add('userName', TextType::class, [
                'label' => 'Nom d’utilisateur',
                'attr' => ['class' => 'form-control']
            ])
            ->add('faru', TextType::class, [
                'label' => 'FARU',
                'attr' => ['class' => 'form-control']
            ])
            ->add('mtt', TextType::class, [
                'label' => 'MTT',
                'attr' => ['class' => 'form-control']
            ])
            ->add('asg', TextType::class, [
                'label' => 'ASG',
                'attr' => ['class' => 'form-control']
            ])
            ->add('ed', TextType::class, [
                'label' => 'ED',
                'attr' => ['class' => 'form-control']
            ])
            ->add('pss', CheckboxType::class, [
                'label' => 'PSS',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('gos', CheckboxType::class, [
                'label' => 'GOS',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('gss', CheckboxType::class, [
                'label' => 'GSS',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('ams', CheckboxType::class, [
                'label' => 'AMS',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('vms', CheckboxType::class, [
                'label' => 'VMS',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('emt', CheckboxType::class, [
                'label' => 'EMT',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('dsi', CheckboxType::class, [
                'label' => 'DSI',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('zd', CheckboxType::class, [
                'label' => 'ZD',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('amf', CheckboxType::class, [
                'label' => 'AMF',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('fpc', CheckboxType::class, [
                'label' => 'FPC',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('techasg', CheckboxType::class, [
                'label' => 'TechASG',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ])
            ->add('sf', CheckboxType::class, [
                'label' => 'SF',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
