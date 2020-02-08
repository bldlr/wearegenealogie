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

        if ($request->query->get('position') == 'parent') {

            $position = 'parent';

            $userParent = $repoParents->findOneBy(['pere' => $user]);

            if (!$userParent) {
                $userParent = $repoParents->findOneBy(['mere' => $user]);
            }

            if ($userParent) {
                if ($user->getSexe() == 'm') {
                    $parents = [
                        $user,
                        $repoUser->find($userParent->getMere()),
                    ];
                    $enfants = $repoParents->findBy(['pere' => $user]);
                } else {
                    $parents = [
                        $repoUser->find($userParent->getPere()),
                        $user,
                    ];
                    $enfants = $repoParents->findBy(['mere' => $user]);
                }
            }
            else {
                $parents = [$user];
                $enfants = [null];
            }

        } elseif ($request->query->get('position') == 'enfant') {

            $position = 'enfant';

            $userEnfant = $repoParents->findOneBy(['user' => $user]);

            if ($userEnfant) {
                $userPere = $repoUser->find($userEnfant->getPere());
                $userMere = $repoUser->find($userEnfant->getMere());

                $enfants = $repoParents->findBy(['pere' => $userPere, 'mere' => $userMere]);
            } else {
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
