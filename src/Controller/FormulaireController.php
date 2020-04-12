<?php

namespace App\Controller;

use App\Data\Data;
use App\Entity\User;
use App\Form\DataType;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function register(Request $request)
    {
        $data = new Data();

        $person = new User();
        $pere = new User();
        $mere = new User();
        
        $data->getPerson($person);
        $data->getPere($pere);
        $data->getMere($mere);

        // $data->getUsers()->add($person);
        // $data->getUsers()->add($pere);
        // $data->getUsers()->add($mere);
        
        
        $form = $this->createForm(DataType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->persist($pere);
            $entityManager->persist($mere);
            $entityManager->flush();

        }

        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
