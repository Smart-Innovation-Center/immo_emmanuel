<?php

namespace App\Entity;

use App\Repository\TransferRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransferRepository::class)
 */
class Transfer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $transferredObjectId;

    /**
     * @ORM\Column(type="integer")
     */
    private $origin;

    /**
     * @ORM\Column(type="integer")
     */
    private $destination;

    /**
     * @ORM\Column(type="json")
     */
    private $etat = [];

    /**
     * @ORM\ManyToOne(targetEntity=TypeTransfer::class, inversedBy="transfers")
     */
    private $typeTranfer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransferredObjectId(): ?int
    {
        return $this->transferredObjectId;
    }

    public function setTransferredObjectId(int $transferredObjectId): self
    {
        $this->transferredObjectId = $transferredObjectId;

        return $this;
    }

    public function getOrigin(): ?int
    {
        return $this->origin;
    }

    public function setOrigin(int $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDestination(): ?int
    {
        return $this->destination;
    }

    public function setDestination(int $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getEtat(): ?array
    {
        return $this->etat;
    }

    public function setEtat(array $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getTypeTranfer(): ?TypeTransfer
    {
        return $this->typeTranfer;
    }

    public function setTypeTranfer(?TypeTransfer $typeTranfer): self
    {
        $this->typeTranfer = $typeTranfer;

        return $this;
    }
}
