<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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

public function findMoteurDeRecherche($value)
{
		
    $value = '%' . $value . '%';
    
    $builder = $this -> createQueryBuilder('u');
    return $builder 
        -> where('u.nom LIKE :value or u.prenom LIKE :value or u.date LIKE :value or u.lieu LIKE :value')
        -> setParameter(':value', $value)
        -> getQuery() -> getResult();
}


    public function findNomAz()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.nom', 'ASC')
		-> getQuery()
		-> getResult();
    }

    public function findNomZa()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.nom', 'DESC')
		-> getQuery()
		-> getResult();
    }

    public function findPrenomAz()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.prenom', 'ASC')
		-> getQuery()
		-> getResult();
    }

    public function findPrenomZa()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.prenom', 'DESC')
		-> getQuery()
		-> getResult();
    }

    public function findDateCroissante()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.date', 'ASC')
		-> getQuery()
		-> getResult();
    }

    public function findDateDecroissante()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.date', 'DESC')
		-> getQuery()
		-> getResult();
    }



    public function findLieuAz()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.lieu', 'ASC')
		-> getQuery()
		-> getResult();
    }

    public function findLieuZa()
    {
		$builder = $this->createQueryBuilder('u');

        return $builder
        -> select('u')
        -> orderBy('u.lieu', 'DESC')
		-> getQuery()
		-> getResult();
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
