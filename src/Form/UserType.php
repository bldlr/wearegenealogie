<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => false
            ])
            ->add('prenom', TextType::class, [
                'required' => false
            ])
            ->add('dateNaissance', DateType::class, [
                'required' => false,
                'years' => range(2020, 1700),
                'input' => 'datetime',
                'label' => "Date de naissance"
            ])
            ->add('villeNaissance', TextType::class, [
                'required' => false,
                'label' => "Ville de naissance"
            ])
            ->add('paysNaissance', TextType::class, [
                'required' => false,
                'label' => "Pays de naissance"
            ])
            ->add('dateDeces', DateType::class, [
                'required' => false,
                'years' => range(2020, 1700),
                'input' => 'datetime',
                'label' => "Date de décès"
            ])
            ->add('villeDeces', TextType::class, [
                'required' => false,
                'label' => "Ville de décès"
            ])
            ->add('paysDeces', TextType::class, [
                'required' => false,
                'label' => "Pays de décès"
            ])
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
