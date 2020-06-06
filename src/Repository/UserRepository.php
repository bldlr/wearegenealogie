<?php

namespace App\Repository;

use App\Entity\User;
use App\Data\SearchData;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

// ----------------------------- FiLTRES DE LA PAGE LISTE ------------------------------------------------

    /**
 * Récupère les Users en lien avec la recherche
 * @return User[]
 */
public function findSearch(SearchData $search): array
{

    $query = $this
        ->createQueryBuilder('u');

        if(!empty($search->q))
        {
            $query = $query
            ->andWhere('u.nom LIKE :q')
            ->orWhere('u.prenom LIKE :q')
            ->orWhere('u.sexe LIKE :q')
            ->orWhere('u.dateNaissance LIKE :q')
            ->orWhere('u.villeNaissance LIKE :q')
            ->orWhere('u.paysNaissance LIKE :q')
            ->orWhere('u.dateDeces LIKE :q')
            ->orWhere('u.villeDeces LIKE :q')
            ->orWhere('u.paysDeces LIKE :q')
            ->setParameter('q', "%{$search->q}%");
        }



        if(!empty($search->sexe))
        {
            $query = $query
            ->andWhere('u.sexe IN (:sexe)')
            ->setParameter('sexe', $search->sexe);
        }

        if(!empty($ordre = $search->ordre))
        {
            switch($ordre)
            {
                case 1 : 
                    $query = $query
                    ->orderBy("u.nom", "ASC");
                break;

                case 2 : 
                    $query = $query
                    ->orderBy("u.nom", "DESC");
                break;

                case 3 : 
                    $query = $query
                    ->orderBy("u.prenom", "ASC");
                break;

                case 4 : 
                    $query = $query
                    ->orderBy("u.prenom", "DESC");
                break;

                case 5 : 
                    $query = $query
                    ->orderBy("u.dateNaissance", "ASC");
                break;

                case 6 : 
                    $query = $query
                    ->orderBy("u.dateNaissance", "DESC");
                break;

                case 7 : 
                    $query = $query
                    ->orderBy("u.villeNaissance", "ASC");
                break;

                case 8 : 
                    $query = $query
                    ->orderBy("u.villeNaissance", "DESC");
                break;

                case 9 : 
                    $query = $query
                    ->orderBy("u.paysNaissance", "ASC");
                break;

                case 10 : 
                    $query = $query
                    ->orderBy("u.paysNaissance", "DESC");
                break;


                case 11 : 
                    $query = $query
                    ->orderBy("u.dateDeces", "ASC");
                break;

                case 12 : 
                    $query = $query
                    ->orderBy("u.dateDeces", "DESC");
                break;

                case 13 : 
                    $query = $query
                    ->orderBy("u.villeDeces", "ASC");
                break;

                case 14 : 
                    $query = $query
                    ->orderBy("u.villeDeces", "DESC");
                break;

                case 15 : 
                    $query = $query
                    ->orderBy("u.paysDeces", "ASC");
                break;

                case 16 : 
                    $query = $query
                    ->orderBy("u.paysDeces", "DESC");
                break;

                default;
            }
            
        }

       

    return $query->getQuery()->getResult();
}

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('u')
    ->andWhere('u.exampleField = :val')
    ->setParameter('val', $value)
    ->orderBy('u.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
    }
     */

    /*
public function findOneBySomeField($value): ?User
{
return $this->createQueryBuilder('u')
->andWhere('u.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
 */
}
