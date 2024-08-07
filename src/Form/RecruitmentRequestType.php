<?php
// src/Form/RecruitmentRequestType.php

namespace App\Form;

use App\Entity\RecruitmentRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruitmentRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hrpFirstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('hrpAge', TextType::class, [
                'label' => 'Âge',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('idUniqueGame', TextType::class, [
                'label' => 'ID Unique du Jeu',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('pseudoDiscord', TextType::class, [
                'label' => 'ID Discord Unique ex:872492767241203742',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('rpFirstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('rpLastName', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('rpSexe', ChoiceType::class, [
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Autre' => 'Autre',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('rpBirthday', DateType::class, [
                'label' => 'Date de Naissance',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('rpPhone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('Motivation', TextareaType::class, [
                'label' => 'Lettre de Motivation',
                'attr' => ['class' => 'form-control', 'rows' => 6],
            ])
            ->add('voiture', CheckboxType::class, [
                'label' => 'Voiture',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3'],
            ])
            ->add('moto', CheckboxType::class, [
                'label' => 'Moto',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3'],
            ])
            ->add('camion', CheckboxType::class, [
                'label' => 'Camion',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3'],
            ])
            ->add('helicoptere', CheckboxType::class, [
                'label' => 'Hélicoptère',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3'],
            ])
            ->add('avion', CheckboxType::class, [
                'label' => 'Avion',
                'required' => false,
                'attr' => ['class' => 'form-check-input ms-3'],
            ])
            ->add('Disponibility', TextareaType::class, [
                'label' => 'Disponibilité',
                'attr' => ['class' => 'form-control', 'rows' => 6],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer la Demande',
                'attr' => ['class' => 'btn btn-primary btn-lg mb-4'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecruitmentRequest::class,
        ]);
    }
}
