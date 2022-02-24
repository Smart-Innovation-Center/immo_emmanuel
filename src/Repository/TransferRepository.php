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

    public function validateTrans($id)
    {
        $type = $this->createQueryBuilder('t')

            ->update('app\Entity\transfer', 't')
            ->set('t.etat', ':etat')
            ->setParameter('etat', 'VALIDE')
            ->where('t.id = ' . $id . '')
            // ->set('t.etat', '=VALIDE')
            ->getQuery()
            ->execute();
        // ->flush();
        return $type;
    }

    public function cancelTrans($id)
    {
        $type = $this->createQueryBuilder('t')
            ->update('app\Entity\transfer', 't')
            ->set('t.etat', ':etat')
            ->setParameter('etat', 'ANNULE')
            ->where('t.id = ' . $id . '')
            ->getQuery()
            ->execute();
        return $type;
    }
}