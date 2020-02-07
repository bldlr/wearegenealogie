<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ParentsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArbreController extends AbstractController
{

    /**
     * @Route("/arbre/{id}", name="arbre")
     */
    public function arbre(User $user, ParentsRepository $repoParents, UserRepository $repoUser, Request $request)
    {
        $enfants = 0;
        if ($request->query->get('position') == 'parent') {
            $enfants = $repoParents->findEnfants($user);

            //$conjoint = $repoParents->findConjoint($user);

            //dump($p);

            // $conjoint = $repoParents->findConjoint($user);
            // dump($conjoint);
        }
        elseif ($request->query->get('position') == 'enfant') {
            dump('blablabla');
        }
        elseif (!$request->query->get('position')) {
            dump('lol');
        }

        return $this->render('arbre/arbre.html.twig', [
            'user' => $user,
            'enfants' => $enfants,
        ]);
    }
}
