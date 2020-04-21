<?php

namespace App\Form;

use App\Entity\UserNode;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Form;

class UserNodeType extends AbstractType
{
    private function injecterCheck(Form $form)
    {
        $form->add('check', CheckboxType::class, [
            'required' => false,
            'mapped' => false,
            'label' => 'Parent inconnu'
            ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users', CollectionType::class, [
                'entry_type' => UserType::class,
                'entry_options' => ['label' => false],
            ])
            ->add('envoyer', SubmitType::class);

        $builder->addEventListener(
            // l'event se déroule juste après qu'on ait envoyé des données dans le formulaire (par exemple quand ça concerne des User déjà présents en BDD)
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                // on boucle sur chaque form et on injecte une checkbox lorsque le form ne s'appelle pas 'personne'
                foreach ($event->getForm()->get('users') as $userForm) {
                    if ($userForm->getName() != 'personne') {
                        $this->injecterCheck($userForm);
                    }
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserNode::class,
        ]);
    }
}
