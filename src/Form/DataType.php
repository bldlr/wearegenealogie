<?php

namespace App\Form;

use App\Data\Data;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DataType extends AbstractType // Symfony saura qu'on est en présence d'un formulaire
{


        public function buildForm(FormBuilderInterface $builder, array $options) // construction du formulaire 2 arg : interface builder et tableau
        {
                $builder
                    ->add('person', CollectionType::class, [
                        'entry_type' => User::class,
                        'entry_options' => ['label' => false],
                        
                    ])
                    ->add('pere', CollectionType::class, [
                        'entry_type' => User::class,
                        'entry_options' => ['label' => false],
                    ])
                    ->add('mere', CollectionType::class, [
                        'entry_type' => User::class,
                        'entry_options' => ['label' => false],
                    ]);
                ;
        }


        public function configureOptions(OptionsResolver $resolver) //Configurer les différentes options liées au formulaire
        {
            $resolver->setDefaults([ // définir des valeurs par défaut
                'data_class' => Data::class, // sur quelle classe on se sert pour représenter les données
                //'csrf_protection' => false // désactiver la protection de cross creating/serving ?
                
            ]);
        }

  











}
