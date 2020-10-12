<?php

namespace App\Repository;

use App\Entity\BankReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BankReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankReference[]    findAll()
 * @method BankReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankReferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankReference::class);
    }

    // /**
    //  * @return BankReference[] Returns an array of BankReference objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BankReference
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
