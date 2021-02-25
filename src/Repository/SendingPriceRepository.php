<?php

namespace App\Repository;

use App\Entity\SendingPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SendingPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method SendingPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method SendingPrice[]    findAll()
 * @method SendingPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SendingPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SendingPrice::class);
    }

    /**
     * @param $methodSending
     * @return int|mixed|string|null
     * @throws NonUniqueResultException
     */
    public function findByMethodSending($methodSending)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.methodSending = :methodSending')
            ->setParameter('methodSending', $methodSending)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    // /**
    //  * @return SendingPrice[] Returns an array of SendingPrice objects
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
    public function findOneBySomeField($value): ?SendingPrice
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
