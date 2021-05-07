<?php

namespace App\Repository;

use App\Entity\Redacteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Redacteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Redacteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Redacteurs[]    findAll()
 * @method Redacteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedacteursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Redacteurs::class);
    }

    // /**
    //  * @return Redacteurs[] Returns an array of Redacteurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Redacteurs
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
