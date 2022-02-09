<?php

namespace App\Repository;

use App\Entity\SiteOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SiteOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteOption[]    findAll()
 * @method SiteOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteOption::class);
    }

    // /**
    //  * @return SiteOption[] Returns an array of SiteOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SiteOption
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
