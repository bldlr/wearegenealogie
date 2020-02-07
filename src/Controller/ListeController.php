<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeController extends AbstractController
{
    /**
     * @Route("/", name="listeMembres")
     */
    public function listeMembres(UserRepository $repoUser)
    {
        $users = $repoUser->findAll();
        return $this->render('liste/liste.html.twig',[
            'users' => $users
        ]
        );
    }

    /**
     * @Route("/moteur_de_recherche", name="moteurDeRecherche")
     */
    public function moteurDeRecherche( Request $request, UserRepository $repoUser)
    {
        $value = $request->query->get('champs');
        $users = $repoUser->findMoteurDeRecherche($value);

        if($users == NULL ){
            $this->addFlash('danger','Aucune réponse');
         }

        return $this->render('liste/liste.html.twig',[
            'users' => $users,
            'value' => $value,
        ]
    );
    }



    /**
     * @Route("/noms_ordre_alphabetique_croissant", name="nomAz")
     */
    public function nomAlphabetiqueCroissant(UserRepository $repoUser)
    {   
        $users = $repoUser->findNomAz();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/noms_ordre_alphabetique_decroissant", name="nomZa")
     */
    public function nomAlphabetiqueDecroissant(UserRepository $repoUser)
    {   
        $users = $repoUser->findNomZa();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }


    /**
     * @Route("/prenoms_ordre_alphabetique_croissant", name="prenomAz")
     */
    public function prenomAlphabetiqueCroissant(UserRepository $repoUser)
    {   
        $users = $repoUser->findPrenomAz();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/prenoms_ordre_alphabetique_decroissant", name="prenomZa")
     */
    public function prenomAlphabetiqueDecroissant(UserRepository $repoUser)
    {   
        $users = $repoUser->findPrenomZa();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/date_croissante", name="dateCroissante")
     */
    public function dateCroissante(UserRepository $repoUser)
    {   
        $users = $repoUser->findDateCroissante();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/date_decroissante", name="dateDecroissante")
     */
    public function dateDecroissante(UserRepository $repoUser)
    {   
        $users = $repoUser->findDateDecroissante();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }


    /**
     * @Route("/lieu_ordre_alphabetique_croissant", name="lieuAz")
     */
    public function lieuAlphabetiqueCroissant(UserRepository $repoUser)
    {   
        $users = $repoUser->findLieuAz();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/lieu_ordre_alphabetique_decroissant", name="lieuZa")
     */
    public function lieuAlphabetiqueDecroissant(UserRepository $repoUser)
    {   
        $users = $repoUser->findLieuZa();

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }


}



