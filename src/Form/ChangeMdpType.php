<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChangeMdpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('password', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Saisir votre nouveau mot de passe',
                    'class' => 'form-control mb-3',
                ],
            ])
            ->add('confirm_password', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmer votre nouveau mot de passe',
                    'class' => 'form-control mb-3',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary btn-block',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Ne lie pas le formulaire à une entité
        ]);
    }
}
