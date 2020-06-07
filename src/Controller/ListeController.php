<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeController extends AbstractController
{
    /**
     * @Route("/liste_membres", name="listeMembres")
     */
    public function listeMembres(UserRepository $repoUser,  Request $request)
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $users = $repoUser->findSearch($data);

        $number = count($repoUser->findSearch($data));
        return $this->render('liste/liste.html.twig',[
            'users' => $users,
            'form' => $form->createView(),
            'number' => $number
        ]
        );
    }

    


}



