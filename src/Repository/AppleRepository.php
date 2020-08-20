<?php

namespace App\Repository;

use App\Entity\Apple;
use App\Entity\AppleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    /**
     * @param AppleSearch $search
     */
    public function findAppleFiltered(AppleSearch $search)
    {
        $query = $this->getApplesQuery();


        if($search->getCategory())
        {
            $query->andWhere('a.category = :categoryId');
            $query->setParameter('categoryId', $search->getCategory());
        }

        if($search->getOrigin())
        {
            $query->andWhere('a.origin = :origin');
            $query->setParameter('origin', $search->getOrigin());
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @return QueryBuilder
     */
    private function getApplesQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC');
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
