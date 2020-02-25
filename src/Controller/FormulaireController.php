<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\FormulaireType;
use App\Form\UserType;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function index()
    {
        $form = $this->createForm(FormulaireType::class, [new User(), new User(), new User()]);

        return $this->render('formulaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
