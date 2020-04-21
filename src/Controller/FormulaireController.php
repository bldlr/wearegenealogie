<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Parents;
use App\Entity\UserNode;
use App\Form\UserNodeType;
use App\Repository\ParentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="usernode_new")
     * @Route("/formulaire/{id}", name="usernode_edit", methods="GET|POST")
     */
    public function newUserNode(Request $request, ParentsRepository $repoParents, User $user = null)
    {
        // SF comprend naturellement le rapport entre {id} dans l'url et une entité User

        $parent = [];
        $userNode = new UserNode();
        
        // s'il n'y a pas d'id dans l'url, on part de trois User vides
        if (!$user) {
            $personne = new User();
            $pere = new User();
            $mere = new User();
        } else {
            // s'il y a un id, on regarde si le user a des parents
            $parent = $repoParents->findOneBy(['user' => $user]);
            if (!$parent) {
                // s'il n'a pas de parents, on n'injecte que lui dans le form
                $personne = $user;
                $pere = new User();
                $mere = new User();
            } else {
                // s'il a des parents, on les injecte tous les trois en partant de leur relation Parent
                $personne = $parent->getUser();
                $pere = $parent->getPere();
                $mere = $parent->getMere();
            }
        }

        // on fait set() pour que le premier argument (la key) apparaisse en tant que titre du formulaire qui lui est attitré
        $userNode->getUsers()->set('personne', $personne);
        $userNode->getUsers()->set('pere', $pere);
        $userNode->getUsers()->set('mere', $mere);

        $form = $this->createForm(UserNodeType::class, $userNode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $userNode = [];

            foreach ($form->get('users') as $userForm) {
                $user = $userForm->getData();
                if ($userForm->getName() != 'personne') {
                    if (!$userForm->get('check')->getData()) {
                        $userNode[$userForm->getName()] = $user;
                        $entityManager->persist($user);
                    }
                } else {
                    $userNode[$userForm->getName()] = $user;
                    $entityManager->persist($user);
                }
            }

            if (!$parent) {
                $parents = new Parents();

                $parentUser = $userNode['personne'];
                $parentPere = isset($userNode['pere']) ? $userNode['pere'] : null;
                $parentMere = isset($userNode['mere']) ? $userNode['mere'] : null;
    
                $parents
                    ->setUser($parentUser)
                    ->setPere($parentPere)
                    ->setMere($parentMere)
                    ;
    
                $entityManager->persist($parents);
            }
            
            $entityManager->flush();

            // redirige sur la page Arbre où l'id Personne ($parentUser) est en position enfant
            return $this->redirectToRoute('arbre', array('id' => $personne->getId(), "position" => "enfant"));
        }

        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
