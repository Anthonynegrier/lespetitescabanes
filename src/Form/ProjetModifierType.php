<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjetModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Nom']
        ])
        ->add('description', TextType::class, [
            'label' => 'Description',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Description']
        ])
        ->add('place', TextType::class, [
            'label' => 'Nombre de Place',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Nombre de Place']
        ])
        ->add('enregistrer', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-success']
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
