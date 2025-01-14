<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class CrecheType extends AbstractType
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
                'attr' => ['class' => 'form-control', 'placeholder' => 'Adresse complète']
            ])
            ->add('capaccite', IntegerType::class, [
                'label' => 'Capacité',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Capacité maximale']
            ])
            ->add('contact', TextType::class, [
                'label' => 'Contact',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Numéro ou e-mail de contact']
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Description de la crèche']
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ville']
            ])
            ->add('copos', TextType::class, [
                'label' => 'Code Postal',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Code postal']
            ])
            ->add('enregistrer', SubmitType::class, [
                'label' => 'Créer la crèche',
                'attr' => ['class' => 'btn btn-success']
            ]);
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\Creche::class,
        ]);
        
    }
}
