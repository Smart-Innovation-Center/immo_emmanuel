<?php

declare(strict_types=1);

namespace App\Service\Structure;

use App\Entity\Agences;
use App\Service\AbstractService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


final class AgenceService extends AbstractService
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

    public function create(Agences $agences): void
    {
        $this->save($agences);
        $this->clearCache('agences_count');
        $this->addFlash('success', 'message.created');
    }

    public function update(Agences $agences): void
    {
        $this->save($agences);
        $this->addFlash('success', 'message.updated');
    }

    public function remove(Agences $agences): void
    {
        $this->em->remove($agences);
        $this->em->flush();
        $this->clearCache('agences_count');
        $this->addFlash('success', 'message.deleted');
    }

    private function save(Agences $agences): void
    {
        $this->em->persist($agences);
        $this->em->flush();
    }
}