<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('personne', TextType::class, [
            'label' => 'Nom Prenom',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Nom Prenom']
        ])
        ->add('description', TextType::class, [
            'label' => 'Avis',
            'attr' => ['class' => 'form-control', 'placeholder' => 'Votre Avis']
        ])
        ->add('enregistrer', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn btn-success']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
