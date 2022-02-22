<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * @var Security
     */
    protected $security;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator, Security $security)
    {
        parent::__construct($registry, Property::class);
        $this->paginator = $paginator;
        $this->security = $security;
    }

    public function findAllPublished(): array
    {
        $qb = $this->createQueryBuilder('p');
        $query = $qb->where("p.state = 'published'")
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        return $query->execute();
    }

    public function countAll(): int
    {
        $count = $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return (int) $count;
    }

    public function countByCat($value): int
    {
        $count = $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->where("p.category = $value")
            ->getQuery()
            ->getSingleScalarResult();
        return (int) $count;
    }

    public function MinPrice(): int
    {
        $minPrice = $this->createQueryBuilder('p')
            ->select('min(p.price)')
            ->getQuery()
            ->getSingleScalarResult();
        return (int) $minPrice;
    }

    public function MaxPrice(): int
    {
        $maxPrice = $this->createQueryBuilder('p')
            ->select('max(p.price)')
            ->getQuery()
            ->getSingleScalarResult();
        return (int) $maxPrice;
    }

    public function MinArea(): int
    {
        $minArea = $this->createQueryBuilder('p')
            ->select('min(p.area)')
            ->getQuery()
            ->getSingleScalarResult();
        return (int) $minArea;
    }

    public function MaxArea(): int
    {
        $maxArea = $this->createQueryBuilder('p')
            ->select('max(p.area)')
            ->getQuery()
            ->getSingleScalarResult();
        return (int) $maxArea;
    }

    public function CountPropertyByType($id)
    {
        $type = $this->createQueryBuilder('p')
            ->where('p.typeProperty = ' . $id . '')
            ->getQuery()
            ->getArrayResult();
        return count($type);
    }

    public function ShowProperty($id)
    {
        $property = $this->createQueryBuilder('p')
            //->from('App\Entity\Property', 'p')
            ->innerJoin('App\Entity\PropertyDescription', 'prodes')
            ->innerJoin('App\Entity\User', 'usr')
            ->where('usr.id = ' . $id . '')
            ->andWhere('usr.id = p.author')
            ->andWhere('prodes.property = p.id')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
        return  $property;
    }


    public function typeProperty($id)
    {
        $type = $this->createQueryBuilder('p')
            ->where('p.typeProperty = ' . $id . '')
            ->getQuery()
            ->getResult();
        return $type;
    }


    public function PropertyBetween($id)
    {
        $property = $this->createQueryBuilder('p')
            ->select('p.slug')
            ->where('p.id = ' . $id . '')
            ->getQuery()
            ->getSingleScalarResult();
        return $property;
    }


    private function findLimit(): int
    {
        $repository = $this->getEntityManager()->getRepository('App:Settings');
        $limit = $repository->findOneBy(['setting_name' => 'items_per_page']);

        return (int) $limit->getSettingValue();
    }

    protected function createPaginator(Query $query, int $page): PaginationInterface
    {
        return $this->paginator->paginate($query, $page, $this->findLimit());
    }
}