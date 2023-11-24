<?php

namespace App\Entity;

use App\Repository\LineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LineRepository::class)
 */
class Line
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=GateActivation::class, mappedBy="line")
     */
    private $gateActivations;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
        $this->gateActivations = new ArrayCollection();
    }

    public function __toString(){
        return $this->getId() . '';
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, GateActivation>
     */
    public function getGateActivations(): Collection
    {
        return $this->gateActivations;
    }

    public function addGateActivation(GateActivation $gateActivation): self
    {
        if (!$this->gateActivations->contains($gateActivation)) {
            $this->gateActivations[] = $gateActivation;
            $gateActivation->setLine($this);
        }

        return $this;
    }

    public function removeGateActivation(GateActivation $gateActivation): self
    {
        if ($this->gateActivations->removeElement($gateActivation)) {
            // set the owning side to null (unless already changed)
            if ($gateActivation->getLine() === $this) {
                $gateActivation->setLine(null);
            }
        }

        return $this;
    }
}
