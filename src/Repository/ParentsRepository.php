<?php

namespace App\Repository;

use App\Entity\Parents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Parents|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parents|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parents[]    findAll()
 * @method Parents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parents::class);
    }




    public function findEnfants($user)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.mere  = :parent')
            ->setParameter('parent', $user[0])
            ->orWhere(' p.pere = :parent')
            ->setParameter('parent', $user[1])
            ->getQuery()
            ->getResult()
        ;
    }

    public function findPere($user)
    {
        return $this->createQueryBuilder('p')
            ->select('parent.id AS pere')
            ->leftJoin('p.pere', 'parent')
            ->andWhere('p.user  = :val ')
            ->setParameter('val', $user)
            ->getQuery()
            ->getResult()
        ;
    }


    public function findMere($user)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.mere', 'parent')
            ->andWhere('p.pere = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getResult()
        ;
    }


    // public function findConjoint($user)
    // {
    //     return $this->createQueryBuilder('p')
    //         ->select('mother.id AS mere')
    //         ->leftJoin('p.mere', 'mother')
    //         ->andWhere('p.pere = :parent ')
    //         ->setParameter('parent', $user)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    
    // if ($personneQuery['sexe'] == 'm') {
    //     $conjointQuery = $pdo->query("SELECT user.id, user.prenom, user.nom FROM user INNER JOIN parent ON parent.mere_id = user.id WHERE parent.mere_id = $personne OR parent.pere_id = $personne")->fetch(PDO::FETCH_ASSOC);
    // } elseif ($personneQuery['sexe'] == 'f') {
    //     $conjointQuery = $pdo->query("SELECT user.id, user.prenom, user.nom FROM user INNER JOIN parent ON parent.pere_id = user.id WHERE parent.mere_id = $personne OR parent.pere_id = $personne")->fetch(PDO::FETCH_ASSOC);
    // }



    // /**
    //  * @return Parents[] Returns an array of Parents objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parents
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
