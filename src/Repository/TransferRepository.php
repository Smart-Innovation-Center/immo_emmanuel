<?php

namespace App\Repository;

use App\Entity\Transfer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transfer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transfer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transfer[]    findAll()
 * @method Transfer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transfer::class);
    }

    public function CountTransferByType($id)
    {
        $type = $this->createQueryBuilder('t')
            ->where('t.typeTranfer = ' . $id . '')
            ->getQuery()
            ->getArrayResult();
        return count($type);
    }

    public function TypeTransfer($id)
    {
        $type = $this->createQueryBuilder('t')
            ->where('t.typeTranfer = ' . $id . '')
            ->getQuery()
            ->getResult();
        return $type;
    }

    public function valTrans($id)
    {


        $type = $this->createQueryBuilder('t')
            ->where('t.id = ' . $id . '')
            ->update('transfer', 't')
            ->set('t.etat', 'VALIDE')
            ->getQuery();
        return $type;
    }
}