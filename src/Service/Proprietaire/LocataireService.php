<?php

declare(strict_types=1);

namespace App\Service\Proprietaire;

use App\Entity\User;
use App\Service\AbstractService;
use App\Transformer\UserTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

final class LocataireService extends AbstractService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $transformer;

    public function __construct(
        CsrfTokenManagerInterface $tokenManager,
        RequestStack $requestStack,
        EntityManagerInterface $entityManager,
        UserTransformer $transformer
    ) {
        parent::__construct($tokenManager, $requestStack);
        $this->em = $entityManager;
        $this->transformer = $transformer;
    }

    public function create(User $locataire): void
    {
        $locataire = $this->transformer->transform($locataire);
        $this->save($locataire);
        $this->clearCache('locataires_count');
        $this->addFlash('success', 'message.created');
    }

    public function update(User $locataire): void
    {
        $locataire = $this->transformer->transform($locataire);
        $this->save($locataire);
        $this->addFlash('success', 'message.updated');
    }

    public function remove(User $locataire): void
    {
        $this->em->remove($locataire);
        $this->em->flush();
        $this->clearCache('locataires_count');
        $this->addFlash('success', 'message.deleted');
    }

    private function save(User $locataire): void
    {
        $this->em->persist($locataire);
        $this->em->flush();
    }
}