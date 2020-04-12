<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Parents;
use App\Entity\UserNode;
use App\Form\Parents1Type;
use App\Form\UserNodeType;
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
            return $this->redirectToRoute('arbre', array('id' => $parentUser->getId(), "position" => "enfant"));
        
        }
        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
