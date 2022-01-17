<?php

declare(strict_types=1);

namespace App\Service\Structure;

use App\Entity\Location;
use App\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


final class LocationService extends AbstractService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(
        CsrfTokenManagerInterface $tokenManager,
        RequestStack $requestStack,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($tokenManager, $requestStack);
        $this->em = $entityManager;
    }

    public function create(Location $location): void
    {
        $this->save($location);
        $this->clearCache('location_count');
        $this->addFlash('success', 'message.created');
    }

    public function update(Location $location): void
    {
        $this->save($location);
        $this->addFlash('success', 'message.updated');
    }

    public function remove(Location $location): void
    {
        $this->em->remove($location);
        $this->em->flush();
        $this->clearCache('Location_count');
        $this->addFlash('success', 'message.deleted');
    }

    private function save(Location $location): void
    {
        $this->em->persist($location);
        $this->em->flush();
    }
}