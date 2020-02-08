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

        // on check d'abord la position du user, car ça va déterminer dans quel sens on génère l'arbre
        if ($request->query->get('position') == 'parent') {

            $position = 'parent';

            // $userParent dit si $user a un enfant (et donc un conjoint)
            // s'il y a au moins un enfant, il contient la première relation qui correspond en BDD
            // en fonction de ça on fait les requêtes qui vont récupérer enfant(s) et conjoint... ou pas (ligne 52)
            $userParent = $repoParents->findOneBy(['pere' => $user]);

            if (!$userParent) {
                $userParent = $repoParents->findOneBy(['mere' => $user]);
            }

            if ($userParent) {

                // on fait des requêtes différentes en fonction du sexe avec un if, car on peut pas faire une requête qui dit "find une relation père OU mère"
                // ensuite on peuple $parents et $enfants qui sont des tableaux arrays
                if ($user->getSexe() == 'm') {
                    $parents = [
                        $user,
                        $repoUser->find($userParent->getMere()),
                    ];
                    foreach ($repoParents->findBy(['pere' => $user]) as $enfant) {
                        $enfants[] = $enfant->getUser();
                    }
                } else {
                    $parents = [
                        $repoUser->find($userParent->getPere()),
                        $user,
                    ];
                    foreach ($repoParents->findBy(['mere' => $user]) as $enfant) {
                        $enfants[] = $enfant->getUser();
                    }
                }

            } else {
                // s'il n'y a pas d'enfant, l'arbre contient uniquement le $user en tant que parent seul
                $parents = [$user];
                $enfants = null;
            }

        } elseif ($request->query->get('position') == 'enfant') {

            $position = 'enfant';
            $enfants = [];

            // à l'inverse d'au-dessus, ici $userParent dit si $user a des parents en BDD
            $userEnfant = $repoParents->findOneBy(['user' => $user]);

            if ($userEnfant) {

                // s'il y a des parents, on les stocke dans leurs variables respectives
                $userPere = $repoUser->find($userEnfant->getPere());
                $userMere = $repoUser->find($userEnfant->getMere());

                // avec cette boucle on récupère la fratrie de $user
                foreach ($repoParents->findBy(['pere' => $userPere, 'mere' => $userMere]) as $enfant) {
                    $enfants[] = $enfant->getUser();
                }

            } else {

                // s'il n'y a pas de parents, tout est null
                // Twig comprend ça et génère un arbre avec un enfant $user et deux parents inconnus
                $userPere = null;
                $userMere = null;
                $enfants = [null];

            }

            $parents = [$userPere, $userMere];
        }

        return $this->render('arbre/arbre.html.twig', [
            'position' => $position,
            'user' => $user,
            'enfants' => $enfants,
            'parents' => $parents,
        ]);
    }
}
