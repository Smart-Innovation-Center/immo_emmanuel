<?php

namespace App\Entity;

use App\Repository\TypePropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypePropertyRepository::class)
 */
class TypeProperty
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
     * @ORM\OneToMany(targetEntity=property::class, mappedBy="typeProperty")
     */
    private $properties;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleurMenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fontawesome;

   
    public function __construct()
    {
        $this->property = new ArrayCollection();
        $this->properties = new ArrayCollection();
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

    /**
     * @return Collection|property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setTypeProperty($this);
        }

        return $this;
    }

    public function removeProperty(property $property): self
    {
        if ($this->properties->removeElement($property)) {
            // set the owning side to null (unless already changed)
            if ($property->getTypeProperty() === $this) {
                $property->setTypeProperty(null);
            }
        }

        return $this;
    }

    public function getCouleurMenu(): ?string
    {
        return $this->couleurMenu;
    }

    public function setCouleurMenu(string $couleurMenu): self
    {
        $this->couleurMenu = $couleurMenu;

        return $this;
    }

    public function getFontawesome(): ?string
    {
        return $this->fontawesome;
    }

    public function setFontawesome(string $fontawesome): self
    {
        $this->fontawesome = $fontawesome;

        return $this;
    }

  
}