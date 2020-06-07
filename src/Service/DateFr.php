<?php

namespace App\Service;

use App\Entity\User;




class DateFr
{
    public function moisNaissanceFr($users)
    {
    
        foreach($users as $user)
        {
            $donnees[$user->getId()] = $user->getDateNaissance();
        }


        foreach($donnees as $k => $date)
        {
            if($date != null)
            {
            $chiffreMois[] = $date->format("m");

                foreach($chiffreMois as $leMois)
                {
                    switch($leMois)
                        {
                            case 1 : 
                            $leMois = "Janvier";
                            break;

                            case 2 : 
                                $leMois = "Février";
                            break;

                            case 3 : 
                                $leMois = "Mars";
                            break;

                            case 4 : 
                                $leMois = "Avril";
                            break;

                            case 5 : 
                                $leMois = "Mai";
                            break;

                            case 6 : 
                                $leMois = "Juin";
                            break;

                            case 7 : 
                                $leMois = "Juillet";
                            break;

                            case 8 : 
                                $leMois = "Août";
                            break;

                            case 9 : 
                                $leMois = "Septembre";
                            break;

                            case 10 : 
                                $leMois = "Octobre";
                            break;

                            case 11 : 
                                $leMois = "Novembre";
                            break;

                            case 12 : 
                                $leMois = "Décembre";
                            break;

                            default;
                        }

                }

                $mois[$k] =  $leMois;
            }
            else
            {
                return null;
            }
        }

        return $mois;

    }


    public function moisDecesFr($users)
    {
    
        foreach($users as $user)
        {
            $donnees[$user->getId()] = $user->getDateDeces();
        }


        foreach($donnees as $k => $date)
        {
            if($date != null)
            {
            $chiffreMois[] = $date->format("m");

                foreach($chiffreMois as $leMois)
                {
                    switch($leMois)
                        {
                            case 1 : 
                            $leMois = "Janvier";
                            break;

                            case 2 : 
                                $leMois = "Février";
                            break;

                            case 3 : 
                                $leMois = "Mars";
                            break;

                            case 4 : 
                                $leMois = "Avril";
                            break;

                            case 5 : 
                                $leMois = "Mai";
                            break;

                            case 6 : 
                                $leMois = "Juin";
                            break;

                            case 7 : 
                                $leMois = "Juillet";
                            break;

                            case 8 : 
                                $leMois = "Août";
                            break;

                            case 9 : 
                                $leMois = "Septembre";
                            break;

                            case 10 : 
                                $leMois = "Octobre";
                            break;

                            case 11 : 
                                $leMois = "Novembre";
                            break;

                            case 12 : 
                                $leMois = "Décembre";
                            break;

                            default;
                        }

                }

                $mois[$k] =  $leMois;
            }
            else
            {
                return null;
            }

        }

        return $mois;

    }










    public function moisNaissanceFrModal(User $user)
    {
    
        $userDate = $user->getDateNaissance();

       
            if($userDate != null)
            {
                $leMois = $userDate->format("m");

                
                    switch($leMois)
                        {
                            case 1 : 
                            $leMois = "Janvier";
                            break;

                            case 2 : 
                                $leMois = "Février";
                            break;

                            case 3 : 
                                $leMois = "Mars";
                            break;

                            case 4 : 
                                $leMois = "Avril";
                            break;

                            case 5 : 
                                $leMois = "Mai";
                            break;

                            case 6 : 
                                $leMois = "Juin";
                            break;

                            case 7 : 
                                $leMois = "Juillet";
                            break;

                            case 8 : 
                                $leMois = "Août";
                            break;

                            case 9 : 
                                $leMois = "Septembre";
                            break;

                            case 10 : 
                                $leMois = "Octobre";
                            break;

                            case 11 : 
                                $leMois = "Novembre";
                            break;

                            case 12 : 
                                $leMois = "Décembre";
                            break;

                            default;

                            
                        }
                        return $leMois;
            }
        
            

    }


    public function moisDecesFrModal(User $user)
    {
    
        $userDate = $user->getDateDeces();

       
            if($userDate != null)
            {
                $leMois = $userDate->format("m");

                
                    switch($leMois)
                        {
                            case 1 : 
                            $leMois = "Janvier";
                            break;

                            case 2 : 
                                $leMois = "Février";
                            break;

                            case 3 : 
                                $leMois = "Mars";
                            break;

                            case 4 : 
                                $leMois = "Avril";
                            break;

                            case 5 : 
                                $leMois = "Mai";
                            break;

                            case 6 : 
                                $leMois = "Juin";
                            break;

                            case 7 : 
                                $leMois = "Juillet";
                            break;

                            case 8 : 
                                $leMois = "Août";
                            break;

                            case 9 : 
                                $leMois = "Septembre";
                            break;

                            case 10 : 
                                $leMois = "Octobre";
                            break;

                            case 11 : 
                                $leMois = "Novembre";
                            break;

                            case 12 : 
                                $leMois = "Décembre";
                            break;

                            default;

                            
                        }
                        return $leMois;
            }
        
            

    }











































}