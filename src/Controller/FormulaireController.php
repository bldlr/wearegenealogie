<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Parents;
use App\Entity\UserNode;
use App\Form\Parents1Type;
use App\Form\UserNodeType;
use App\Repository\UserRepository;
use App\Repository\ParentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/usernode/new", name="usernode_new")
     */
    public function newUserNode(Request $request)
    {
        $userNode = new UserNode();

        $personne = new User();
        $personne
            ->setNom('Virus')
            ->setPrenom('Corona')
            ->setDate(new DateTime('1/01/2006'))
            ->setLieu('Paris')
            ->setSexe('m')
            ;
        $pere = new User();
        $pere
            ->setNom('N1')
            ->setPrenom('H1')
            ->setDate(new DateTime('1/01/1970'))
            ->setLieu('Paris')
            ->setSexe('m')
            ;
        $mere = new User();
        $mere
            ->setNom('DS')
            ->setPrenom('AI')
            ->setDate(new DateTime('1/01/1970'))
            ->setLieu('Paris')
            ->setSexe('f')
            ;

        // on fait set() pour que le premier argument (la key) apparaisse en tant que titre du formulaire qui lui est attitré
        $userNode->getUsers()->set('personne', $personne);
        $userNode->getUsers()->set('pere', $pere);
        $userNode->getUsers()->set('mere', $mere);

        $form = $this->createForm(UserNodeType::class, $userNode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userNodeUsers = $form->getData()->getUsers();
            $entityManager = $this->getDoctrine()->getManager();

            // TODO : rajouter ici la création de relations Parent entre les User
            foreach ($userNodeUsers as $user) {
                $entityManager->persist($user);
                $entityManager->flush();
            }
        
            $parents = new Parents();

            $parentUser = $userNodeUsers['personne'];
            $parentPere = $userNodeUsers['pere'];
            $parentMere = $userNodeUsers['mere'];
            
                $parents->setUser($parentUser);
                $parents->setPere($parentPere);
                $parents->setMere($parentMere);

                $entityManagers = $this->getDoctrine()->getManager();
                $entityManagers->persist($parents);
                $entityManagers->flush();
    
            // redirige sur la page Arbre où l'id Personne ($parentUser) est en position enfant
            return $this->redirectToRoute('arbre_construction', array('id' => $parentUser->getId(), "position" => "enfant"));
        
        }
        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }




    /**
     * @Route("/arbre_construction/{id}", name="arbre_construction")
     */
    public function arbreConstruction(User $user, ParentsRepository $repoParents, UserRepository $repoUser, Request $request)
    {

        // on check d'abord la position du user, car ça va déterminer dans quel sens on génère l'arbre
        if ($request->query->get('position') == 'parent') {

            $position = 'parent';

            // $userParent dit si $user a un enfant (et donc un conjoint)
            // s'il y a au moins un enfant, il contient la première relation qui correspond en BDD
            // en fonction de ça on fait les requêtes qui vont récupérer enfant(s) et conjoint... ou pas (ligne 52)
            $userParent = $repoParents->findOneBy(['pere' => $user]);

            if (!$userParent) {
                $userParent = $repoParents->findOneBy(['mere' => $user]);
            }

            if ($userParent) {

                // on fait des requêtes différentes en fonction du sexe avec un if, car on peut pas faire une requête qui dit "find une relation père OU mère"
                // ensuite on peuple $parents et $enfants qui sont des tableaux arrays
                if ($user->getSexe() == 'm') {
                    $parents = [
                        $user,
                        $repoUser->find($userParent->getMere()),
                    ];
                    $enfantsRepoParents = $repoParents->findEnfantsPereOrder($user);
                    foreach ($enfantsRepoParents as $enfant) {
                        $enfants[] = $enfant->getUser();
                    }
                } else {
                    $parents = [
                        $repoUser->find($userParent->getPere()),
                        $user,
                    ];
                    $enfantsRepoParents = $repoParents->findEnfantsMereOrder($user);
                    foreach ($enfantsRepoParents as $enfant) {
                        $enfants[] = $enfant->getUser();
                    }
                }

            } else {
                // s'il n'y a pas d'enfant, l'arbre contient uniquement le $user en tant que parent seul
                $parents = [$user];
                $enfants = null;
            }

        } elseif ($request->query->get('position') == 'enfant') {

            $position = 'enfant';
            $enfants = [];

            // à l'inverse d'au-dessus, ici $userParent dit si $user a des parents en BDD
            $userEnfant = $repoParents->findOneBy(['user' => $user]);

            if ($userEnfant) {

                // s'il y a des parents, on les stocke dans leurs variables respectives
                $userPere = $repoUser->find($userEnfant->getPere());
                $userMere = $repoUser->find($userEnfant->getMere());

                // avec cette boucle on récupère la fratrie de $user
                foreach ($repoParents->findFratrieOrder($userPere, $userMere) as $enfant) {
                    $enfants[] = $enfant->getUser();
                }

            } else {

                // s'il n'y a pas de parents, tout est null
                // Twig comprend ça et génère un arbre avec un enfant $user et deux parents inconnus
                $userPere = null;
                $userMere = null;
                $enfants = [null];

            }

            $parents = [$userPere, $userMere];
        }

        return $this->render('formulaire/arbreConstruction.html.twig', [
            'position' => $position,
            'user' => $user,
            'enfants' => $enfants,
            'parents' => $parents,
        ]);
    }


    
    /**
     * @Route("/form/{id}", name="form")
     */
    public function form(User $user, ParentsRepository $repoParents, UserRepository $repoUser, Request $request)
    {

        $userNode = new UserNode();

        $personne = $user; 

        $pere = new User();
        $pere
            ->setNom('N2')
            ->setPrenom('H2')
            ->setDate(new DateTime('1/01/1970'))
            ->setLieu('Paris')
            ->setSexe('m')
            ;
        $mere = new User();
        $mere
            ->setNom('DS5')
            ->setPrenom('AIDS')
            ->setDate(new DateTime('1/01/1970'))
            ->setLieu('Paris')
            ->setSexe('f')
            ;

        // on fait set() pour que le premier argument (la key) apparaisse en tant que titre du formulaire qui lui est attitré
        $userNode->getUsers()->set('personne', $personne);
        $userNode->getUsers()->set('pere', $pere);
        $userNode->getUsers()->set('mere', $mere);

        $form = $this->createForm(UserNodeType::class, $userNode);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userNodeUsers = $form->getData()->getUsers();
            $entityManager = $this->getDoctrine()->getManager();

            // TODO : rajouter ici la création de relations Parent entre les User
            foreach ($userNodeUsers as $user) {
                $entityManager->persist($user);
                $entityManager->flush();
            }
        
            $parents = new Parents();

            $parentUser = $userNodeUsers['personne'];
            $parentPere = $userNodeUsers['pere'];
            $parentMere = $userNodeUsers['mere'];
            
                $parents->setUser($parentUser);
                $parents->setPere($parentPere);
                $parents->setMere($parentMere);

                $entityManagers = $this->getDoctrine()->getManager();
                $entityManagers->persist($parents);
                $entityManagers->flush();
    
            // redirige sur la page Arbre où l'id Personne ($parentUser) est en position enfant
            return $this->redirectToRoute('arbre_construction', array('id' => $parentUser->getId(), "position" => "enfant"));
        
        }
        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }





}
