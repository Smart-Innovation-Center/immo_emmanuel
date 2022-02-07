<?php

namespace App\Repository;

use App\Entity\TypeTransfer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeTransfer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTransfer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTransfer[]    findAll()
 * @method TypeTransfer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTransferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeTransfer::class);
    }

    // /**
    //  * @return TypeTransfer[] Returns an array of TypeTransfer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeTransfer
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
