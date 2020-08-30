<?php

namespace App\Repository;

use App\Entity\Insuranse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Insuranse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Insuranse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Insuranse[]    findAll()
 * @method Insuranse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsuranseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Insuranse::class);
    }

    // /**
    //  * @return Insuranse[] Returns an array of Insuranse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Insuranse
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
