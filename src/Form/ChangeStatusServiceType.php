<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ChangeStatusServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('services', ChoiceType::class, [
                'choices' => [
                    'Code 1' => 'Code 1',
                    'Code 3' => 'Code 3',
                    'Code 6' => 'Code 6',
                    'Code 7' => 'Code 7',
                ],
                'label' => 'Service',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('lieu', ChoiceType::class, [
                'choices' => [
                    'Los Santos' => 'Los Santos',
                    'Paleto Bay' => 'Paleto Bay',
                    'Sandy Shores' => 'Sandy Shores',
                    'Grapeseed' => 'Grapeseed',
                ],
                'label' => 'Lieu',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('vehicule', ChoiceType::class, [
                'choices' => [
                    'Ambulance' => 'Ambulance',
                    'Véhicule de patrouille' => 'Véhicule de patrouille',
                    'Véhicule de transport' => 'Véhicule de transport',
                ],
                'label' => 'Véhicule',
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('detail', TextType::class, [
                'label' => 'Détail',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Détail',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
