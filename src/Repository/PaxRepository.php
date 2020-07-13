<?php

namespace App\Repository;

use App\Entity\Pax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pax|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pax|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pax[]    findAll()
 * @method Pax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pax::class);
    }

    // /**
    //  * @return Pax[] Returns an array of Pax objects
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
    public function findOneBySomeField($value): ?Pax
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
