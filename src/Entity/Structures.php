<?php

namespace App\Entity;

use App\Repository\StructuresRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=StructuresRepository::class)
 * @UniqueEntity(fields = {"libelle"}, message="Le libellé existe dèjà")
 * @UniqueEntity(fields = {"email"}, message="L'email existe déjà")
 * @UniqueEntity(fields = {"contact"}, message="Le contact existe déjà")
 * @UniqueEntity(fields = {"siteWeb"}, message="Le site Web existe déjà")
 */
class Structures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private $siteWeb;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateSuppression;

    /**
     * @ORM\OneToMany(targetEntity=Agences::class, mappedBy="structure_id")
     */
    private $agences;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumeroRegisteDeCommerce;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $documents;





    public function __construct()
    {
        $this->dateCreation = new \DateTimeImmutable();
        $this->dateModification = new \DateTimeImmutable();
        $this->agences = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->dateModif;
    }

    public function setDateModif(?\DateTimeInterface $dateModif): self
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    public function getDateSuppression(): ?\DateTimeInterface
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(?\DateTimeInterface $dateSuppression): self
    {
        $this->dateSuppression = $dateSuppression;

        return $this;
    }

    /**
     * @return Collection|Agences[]
     */
    public function getAgences(): Collection
    {
        return $this->agences;
    }

    public function addAgence(Agences $agence): self
    {
        if (!$this->agences->contains($agence)) {
            $this->agences[] = $agence;
            $agence->setStructureId($this);
        }

        return $this;
    }

    public function removeAgence(Agences $agence): self
    {
        if ($this->agences->removeElement($agence)) {
            // set the owning side to null (unless already changed)
            if ($agence->getStructureId() === $this) {
                $agence->setStructureId(null);
            }
        }

        return $this;
    }

    public function getNumeroRegisteDeCommerce(): ?string
    {
        return $this->NumeroRegisteDeCommerce;
    }

    public function setNumeroRegisteDeCommerce(string $NumeroRegisteDeCommerce): self
    {
        $this->NumeroRegisteDeCommerce = $NumeroRegisteDeCommerce;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function setDocuments(string $documents): self
    {
        $this->documents = $documents;

        return $this;
    }
}