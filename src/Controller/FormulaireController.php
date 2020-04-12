<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserNode;
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
        $pere = new User();
        $mere = new User();

        // on fait set() pour que le premier argument (la key) apparaisse en tant que titre du formulaire qui lui est attitré
        $userNode->getUsers()->set('personne', $personne);
        $userNode->getUsers()->set('pere', $pere);
        $userNode->getUsers()->set('mere', $mere);

        $form = $this->createForm(UserNodeType::class, $userNode);

        $form->handleRequest($request);

        dump($form);

        if ($form->isSubmitted() && $form->isValid()) {

            $userNode = $form->getData();
            dump($userNode);


            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($userNode);
            // $entityManager->flush();

            // return $this->redirectToRoute('listeMembres');
        }

        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
