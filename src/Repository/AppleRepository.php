<?php

namespace App\Repository;

use App\Entity\Apple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apple|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apple|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apple[]    findAll()
 * @method Apple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apple::class);
    }

    // /**
    //  * @return Apple[] Returns an array of Apple objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Apple
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
