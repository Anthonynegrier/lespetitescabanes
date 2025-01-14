<?php

namespace App\Form;

use App\Entity\Creche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CrecheModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom de la crèche',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Nom de la crèche']
        ])
        ->add('adresse', TextType::class, [
            'label' => 'Adresse',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse de la crèche']
        ])
        ->add('capaccite', IntegerType::class, [
            'label' => 'Capacité',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Capacité de la crèche']
        ])
        ->add('contact', TextType::class, [
            'label' => 'Contact',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro de contact']
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Description de la crèche']
        ])
        ->add('ville', TextType::class, [
            'label' => 'Ville',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Ville de la crèche']
        ])
        ->add('copos', TextType::class, [
            'label' => 'Code postal',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Code postal']
        ])
        ->add('enregistrer', SubmitType::class, [
            'label' => 'Enregistrer la crèche',
            'attr' => ['class' => 'btn btn-success']
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Creche::class,
        ]);
    }
}
