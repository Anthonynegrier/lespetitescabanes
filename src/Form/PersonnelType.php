<?php

namespace App\Form;

use App\Entity\Personnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonnelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Nom']
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prenom',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Prenom']
        ])
        ->add('poste', TextType::class, [
            'label' => 'Poste Occupé',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Poste Occupé']
        ])
        ->add('enregistrer', SubmitType::class, [
            'label' => 'Créer',
            'attr' => ['class' => 'btn btn-success']
        ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\Personnel::class,
        ]);
    }
}
