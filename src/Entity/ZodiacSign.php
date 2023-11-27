<?php

namespace App\Entity;

use App\Repository\ZodiacSignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZodiacSignRepository::class)
 */
class ZodiacSign
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unciode;

    /**
     * @ORM\Column(type="integer")
     */
    private $degreeFrom;

    /**
     * @ORM\Column(type="integer")
     */
    private $degreeTo;

    /**
     * @ORM\OneToMany(targetEntity=Gate::class, mappedBy="degreeFromSign")
     */
    private $gatesFrom;

    /**
     * @ORM\OneToMany(targetEntity=Gate::class, mappedBy="degreeToSign")
     */
    private $gatesTo;

    public function __construct()
    {
        $this->gatesFrom = new ArrayCollection();
        $this->gatesTo = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName() . ' ' . $this->getUnciode();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnciode(): ?string
    {
        return $this->unciode;
    }

    public function setUnciode(string $unciode): self
    {
        $this->unciode = $unciode;

        return $this;
    }

    public function getDegreeFrom(): ?int
    {
        return $this->degreeFrom;
    }

    public function setDegreeFrom(int $degreeFrom): self
    {
        $this->degreeFrom = $degreeFrom;

        return $this;
    }


    public function getDegreeTo(): ?int
    {
        return $this->degreeTo;
    }

    public function setDegreeTo(int $degreeTo): self
    {
        $this->degreeTo = $degreeTo;

        return $this;
    }

    /**
     * @return Collection<int, Gate>
     */
    public function getGatesFrom(): Collection
    {
        return $this->gatesFrom;
    }

    public function addGatesFrom(Gate $gatesFrom): self
    {
        if (!$this->gatesFrom->contains($gatesFrom)) {
            $this->gatesFrom[] = $gatesFrom;
            $gatesFrom->setDegreeFromSign($this);
        }

        return $this;
    }

    public function removeGatesFrom(Gate $gatesFrom): self
    {
        if ($this->gatesFrom->removeElement($gatesFrom)) {
            // set the owning side to null (unless already changed)
            if ($gatesFrom->getDegreeFromSign() === $this) {
                $gatesFrom->setDegreeFromSign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Gate>
     */
    public function getGatesTo(): Collection
    {
        return $this->gatesTo;
    }

    public function addGatesTo(Gate $gatesTo): self
    {
        if (!$this->gatesTo->contains($gatesTo)) {
            $this->gatesTo[] = $gatesTo;
            $gatesTo->setDegreeToSign($this);
        }

        return $this;
    }

    public function removeGatesTo(Gate $gatesTo): self
    {
        if ($this->gatesTo->removeElement($gatesTo)) {
            // set the owning side to null (unless already changed)
            if ($gatesTo->getDegreeToSign() === $this) {
                $gatesTo->setDegreeToSign(null);
            }
        }

        return $this;
    }
}
