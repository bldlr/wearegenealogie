<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchForm extends AbstractType 
{


        public function buildForm(FormBuilderInterface $builder, array $options)
        {
                $builder
                    ->add('q', TextType::class, [
                        'label' => false,
                        'required' => false, 
                        'attr' => [
                            'placeholder' => 'Rechercher' 
                        ]
                    ])

                    ->add('ordre', ChoiceType::class, [
                        'required' => false,
                        'label' => false,
                        'choices' => [
                            'Nom Croissant' => 1,
                            'Nom Décroissant' => 2,
                            'Prenom Croissant' => 3,
                            'Prenom Décroissant' => 4,
                            'Date de naissance croissante' => 5,
                            'Date de naissance décroissante' => 6,
                            'Ville de naissance croissante' => 7,
                            'Ville de naissance décroissante' => 8,
                            'Pays de naissance croissant' => 9,
                            'Pays de naissance décroissant' => 10,
                            'Date de décès croissante' => 11,
                            'Date de décès décroissante' => 12,
                            'Ville de décès croissante' => 13,
                            'Ville de décès décroissante' => 14,
                            'Pays de décès croissant' => 15,
                            'Pays de décès décroissant' => 16,
                        ]
                    ])

                    
                    ->add('sexe', ChoiceType::class, [
                        'label' => false,
                        'required' => false,
                        'expanded' => true, 
                        'multiple' => true,
                        'choices' => [
                            'Homme' => 'm',
                            'Femme' => 'f',
                        ]
                    ])


                    
                ;
        }


        public function configureOptions(OptionsResolver $resolver) 
        {
            $resolver->setDefaults([ 
                'data_class' => SearchData::class, 
                'method' => 'GET',
                'csrf_protection' => false
            ]);
        }

        public function getBlockPrefix() 
        {
            return ''; 
        }

        












}