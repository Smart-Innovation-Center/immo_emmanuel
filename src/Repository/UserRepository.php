<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function countAll(): int
    {
        $count = $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return (int) $count;
    }

    public function testUser($agceid, $strcid)
    {
        $term = "ROLE_PROPRIETAIRE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            //->select('count(u.id)')
            ->from('App\Entity\User', 'usr')
            ->join('App\Entity\Agences', 'agce')
            //->join('App\Entity\User', 'usr')
            ->join('App\Entity\Structures', 'strc')
            ->where('agce.structure_id = ' . $strcid . '')
            ->AndWhere('u.AgenceId  = agce.id')
            ->AndWhere('u.roles LIKE :rle')
            ->setParameter('rle', '%' . $term . '%')
            ->groupBy('u.username')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function testUserL($agceid, $strcid)
    {
        $term = "ROLE_LOCATAIRE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            //->select('count(u.id)')
            ->from('App\Entity\User', 'usr')
            ->join('App\Entity\Agences', 'agce')
            //->join('App\Entity\User', 'usr')
            ->join('App\Entity\Structures', 'strc')
            ->where('agce.structure_id = ' . $strcid . '')
            ->AndWhere('u.AgenceId  = agce.id')
            ->AndWhere('u.roles LIKE :rle')
            ->setParameter('rle', '%' . $term . '%')
            ->groupBy('u.username')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function testUserU()
    {
        $term = "ROLE_STRUCTURE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->from('App\Entity\User', 'usr')
            ->AndWhere('u.roles LIKE :rle')
            ->setParameter('rle', '%' . $term . '%')
            ->groupBy('u.username')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }
}