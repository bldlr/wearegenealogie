<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\DateFr;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeController extends AbstractController
{
    /**
     * @Route("/liste_membres", name="listeMembres")
     */
    public function listeMembres(UserRepository $repoUser, DateFr $dateFr)
    {
        $users = $repoUser->findAll();
        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);
        return $this->render('liste/liste.html.twig',[
            'users' => $users,
            'moisNaissance' => $moisNaissance,
            'moisDeces' => $moisDeces,
        ]
        );
    }

    /**
     * @Route("/moteur_de_recherche", name="moteurDeRecherche")
     */
    public function moteurDeRecherche( Request $request, UserRepository $repoUser, DateFr $dateFr)
    {
        $value = $request->query->get('champs');
        $users = $repoUser->findMoteurDeRecherche($value);


        if($users == NULL )
        {
            $this->addFlash('danger','Aucune réponse');
        }

        $userss = $repoUser->findAll();
        $moisNaissance = $dateFr->moisNaissanceFr($userss);
        $moisDeces = $dateFr->moisDecesFr($userss);

        return $this->render('liste/liste.html.twig',[
            'users' => $users,
            'value' => $value,
            'moisNaissance' => $moisNaissance,
            'moisDeces' => $moisDeces,
        ]
    );
    }



    /**
     * @Route("/noms_ordre_alphabetique_croissant", name="nomAz")
     */
    public function nomAlphabetiqueCroissant(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findNomAz();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/noms_ordre_alphabetique_decroissant", name="nomZa")
     */
    public function nomAlphabetiqueDecroissant(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findNomZa();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }


    /**
     * @Route("/prenoms_ordre_alphabetique_croissant", name="prenomAz")
     */
    public function prenomAlphabetiqueCroissant(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findPrenomAz();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/prenoms_ordre_alphabetique_decroissant", name="prenomZa")
     */
    public function prenomAlphabetiqueDecroissant(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findPrenomZa();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/date_croissante", name="dateCroissante")
     */
    public function dateCroissante(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findDateCroissante();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/date_decroissante", name="dateDecroissante")
     */
    public function dateDecroissante(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findDateDecroissante();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }


    /**
     * @Route("/lieu_ordre_alphabetique_croissant", name="lieuAz")
     */
    public function lieuAlphabetiqueCroissant(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findLieuAz();

        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }

    /**
     * @Route("/lieu_ordre_alphabetique_decroissant", name="lieuZa")
     */
    public function lieuAlphabetiqueDecroissant(UserRepository $repoUser, DateFr $dateFr)
    {   
        $users = $repoUser->findLieuZa();


        $moisNaissance = $dateFr->moisNaissanceFr($users);
        $moisDeces = $dateFr->moisDecesFr($users);

        return $this->render('liste/liste.html.twig',
            compact('users')
        );
    }


}



