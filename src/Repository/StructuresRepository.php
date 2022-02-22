<?php

namespace App\Repository;

use App\Entity\Structures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Structures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Structures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Structures[]    findAll()
 * @method Structures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StructuresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Structures::class);
    }

    public function InitiateurStructure($id)
    {
        $structure = $this->createQueryBuilder('s')
            ->select('s.libelle')
            ->where('s.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $structure;
    }

    public function ReciveStructure($id)
    {
        $structure = $this->createQueryBuilder('s')
            ->select('s.libelle')
            ->where('s.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $structure;
    }
}