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
            ->from('App\Entity\User', 'usr')
            ->join('App\Entity\Agences', 'agce')
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

    public function ShowAgent($id)
    {
        $agent = $this->createQueryBuilder('u')
            ->where('u.AgenceId = ' . $id . '')
            ->getQuery()
            ->getResult();
        return $agent;
    }

    public function CountL($agceid, $strcid)
    {
        $term = "ROLE_LOCATAIRE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->from('App\Entity\User', 'usr')
            ->join('App\Entity\Agences', 'agce')
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

    public function CountP($agceid, $strcid)
    {
        $term = "ROLE_PROPRIETAIRE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->from('App\Entity\User', 'usr')
            ->join('App\Entity\Agences', 'agce')
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


    public function nbr_of_Tenant()
    {
        $term = "ROLE_LOCATAIRE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->where('u.roles LIKE :rle ')
            ->setParameter('rle', '%' . $term . '%')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function nbr_of_owner()
    {
        $term = "ROLE_PROPRIETAIRE";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->where('u.roles LIKE :rle ')
            ->setParameter('rle', '%' . $term . '%')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function nbr_of_Technician()
    {
        $term = "ROLE_TECHNICIAN";
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->where('u.roles LIKE :rle ')
            ->setParameter('rle', '%' . $term . '%')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function InitiateurOwner($id)
    {
        $user = $this->createQueryBuilder('u')
            ->select('u.username')
            ->where('u.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $user;
    }

    public function OwnerBetween($id)
    {
        $user = $this->createQueryBuilder('u')
            ->select('u.username')
            ->where('u.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $user;
    }

    public function ReciveOwner($id)
    {
        $user = $this->createQueryBuilder('u')
            ->select('u.username')
            ->where('u.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $user;
    }

    public function actUser()
    {
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->where('u.atcif = true')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function NoActUser()
    {
        $qb = $this->createQueryBuilder('u');
        $classes = $qb
            ->where('u.atcif = false')
            ->getQuery()
            ->getArrayResult();
        return $classes;
    }

    public function activeUser($id)
    {
        $type = $this->createQueryBuilder('u')

            ->update('App\Entity\User', 'u')
            ->set('u.atcif', ':etat')
            ->setParameter('etat', true)
            ->where('u.id = ' . $id . '')
            ->getQuery()
            ->execute();
        return $type;
    }

    public function blockUser($id)
    {
        $type = $this->createQueryBuilder('u')
            ->update('app\Entity\User', 'u')
            ->set('u.atcif', ':etat')
            ->setParameter('etat', false)
            ->where('u.id = ' . $id . '')
            ->getQuery()
            ->execute();
        return $type;
    }
}