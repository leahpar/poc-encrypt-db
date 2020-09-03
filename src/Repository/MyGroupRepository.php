<?php

namespace App\Repository;

use App\Entity\MyGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyGroup[]    findAll()
 * @method MyGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyGroup::class);
    }

    // /**
    //  * @return MyGroup[] Returns an array of MyGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyGroup
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
