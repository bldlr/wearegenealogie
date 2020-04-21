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
            $userNode = []; // variable qui sert à stocker les User pour renseigner la relation Parents (s'il faut en créer une)

            // on boucle sur chaque form (et non pas directement les User)
            foreach ($form->get('users') as $userForm) {
                // 1 form = 1 user, ici on le récupère
                $user = $userForm->getData();
                // comme on boucle sur les form, on a accès à leurs clés dans l'arraycollection du UserNode, du coup on peut faire deux conditions qui disent : si le form ne s'appelle pas 'personne' et qu'on n'a pas coché Parent inconnu, alors ce User est persist et sera renseigné dans le Parents
                if ($userForm->getName() != 'personne') {
                    if (!$userForm->get('check')->getData()) {
                        $userNode[$userForm->getName()] = $user;
                        $entityManager->persist($user);
                    }
                // si on n'est pas rentré dans le if, c'est que c'est le form de $personne, on le persist dans tous les cas
                } else {
                    $userNode[$userForm->getName()] = $user;
                    $entityManager->persist($user);
                }
            }

            // si au début du Controller on n'a pas trouvé de Parents correspond à $personne, on va créer une nouvelle relation
            if (!$parent) {
                $parents = new Parents();

                // les différentes personnes sont récupérées depuis $userNode
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
