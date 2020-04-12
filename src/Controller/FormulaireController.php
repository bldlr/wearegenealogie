<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserNode;
use App\Form\UserNodeType;
use DateTime;
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

        dump($userNode);

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
