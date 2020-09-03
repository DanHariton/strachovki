<?php

namespace App\Repository;

use App\Entity\InsurancePrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InsurancePrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method InsurancePrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method InsurancePrice[]    findAll()
 * @method InsurancePrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsurancePriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InsurancePrice::class);
    }

    /**
     * @param $name
     * @return InsurancePrice|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByName($name)
    {
        return $this->createQueryBuilder('ip')
            ->andWhere('ip.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return InusrancePrice[] Returns an array of InusrancePrice objects
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
    public function findOneBySomeField($value): ?InusrancePrice
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
