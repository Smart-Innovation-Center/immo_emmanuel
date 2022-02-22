<?php

namespace App\Repository;

use App\Entity\Agences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Agences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agences[]    findAll()
 * @method Agences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agences::class);
    }

    public function countA($strcid)
    {
        $qb = $this->createQueryBuilder('a');
        $classes = $qb
            //->select('count(u.id)')
            ->where('a.structure_id = ' . $strcid . '')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function InitiateurAgence($id)
    {
        $agency = $this->createQueryBuilder('a')
            ->select('a.libelle')
            ->where('a.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $agency;
    }

    public function AgencyBetween($id)
    {
        $agency = $this->createQueryBuilder('a')
            ->select('a.libelle')
            ->where('a.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $agency;
    }

    public function ReciveAgence($id)
    {
        $agency = $this->createQueryBuilder('a')
            ->select('a.libelle')
            ->where('a.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $agency;
    }
}