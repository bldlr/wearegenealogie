<?php

namespace App\Form;

use App\Entity\Parents;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', CollectionType::class, [
                'entry_type' => UserType::class
            ])
            ->add('pere', CollectionType::class, [
                'entry_type' => UserType::class
            ])
            ->add('mere', CollectionType::class, [
                'entry_type' => UserType::class
            ])
            ->add('Envoyer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parents::class,
        ]);
    }
}
