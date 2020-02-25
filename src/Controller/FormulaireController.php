<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Parents;
use App\Form\ParentsType;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function index()
    {
        $parents = new Parents();

        $form = $this->createForm(ParentsType::class, $parents);

        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
