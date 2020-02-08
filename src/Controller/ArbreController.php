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

            $position = 'parent';
            $enfants = $repoParents->findEnfants($user);
            dump($enfants);

            // le conjoint est une entité de la table User
            // on le retrouve dans la table Parent par sa relation avec son enfant et son conjoint
            // du coup on appelle le repoUser pour récupérer ce conjoint selon l'enfant qui est retourné par repoParents avec findOneBy()
            if ($user->getSexe() == 'm') {
                $conjoint = $repoUser->find($repoParents->findOneBy(['pere' => $user])->getMere());
            }
            else {
                $conjoint = $repoUser->find($repoParents->findOneBy(['mere' => $user])->getPere());
            }


        } elseif ($request->query->get('position') == 'enfant') {

            $position = 'enfant';
            dump('blablabla');

        } elseif (!$request->query->get('position')) {

            dump('lol');

        }

        return $this->render('arbre/arbre.html.twig', [
            'position' => $position,
            'user' => $user,
            'conjoint' => $conjoint,
            'enfants' => $enfants,
        ]);
    }
}
