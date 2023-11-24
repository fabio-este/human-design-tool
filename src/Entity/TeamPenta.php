<?php

namespace App\Entity;

use App\Repository\TeamPentaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamPentaRepository::class)
 */
class TeamPenta
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Bodygraph::class, inversedBy="teamPentas")
     */
    private $bodygraphs;

    /**
     * @ORM\Column(type="integer")
     */
    private $presence;

    /**
     * @ORM\Column(type="integer")
     */
    private $structure;

    /**
     * @ORM\Column(type="integer")
     */
    private $execution;

    /**
     * @ORM\Column(type="integer")
     */
    private $vigilence;

    /**
     * @ORM\Column(type="integer")
     */
    private $analysis;

    /**
     * @ORM\Column(type="integer")
     */
    private $focus;

    /**
     * @ORM\Column(type="integer")
     */
    private $planning;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     */
    private $culture;

    /**
     * @ORM\Column(type="integer")
     */
    private $commitment;

    /**
     * @ORM\Column(type="integer")
     */
    private $reliability;

    /**
     * @ORM\Column(type="integer")
     */
    private $coordination;

    public function __construct()
    {
        $this->bodygraphs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Bodygraph>
     */
    public function getBodygraphs(): Collection
    {
        return $this->bodygraphs;
    }

    public function addBodygraph(Bodygraph $bodygraph): self
    {
        if (!$this->bodygraphs->contains($bodygraph)) {
            $this->bodygraphs[] = $bodygraph;
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $bodygraph): self
    {
        $this->bodygraphs->removeElement($bodygraph);

        return $this;
    }

    public function getPresence(): ?int
    {
        return $this->presence;
    }

    public function setPresence(int $presence): self
    {
        $this->presence = $presence;

        return $this;
    }

    public function getStructure(): ?int
    {
        return $this->structure;
    }

    public function setStructure(int $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getExecution(): ?int
    {
        return $this->execution;
    }

    public function setExecution(int $execution): self
    {
        $this->execution = $execution;

        return $this;
    }

    public function getVigilence(): ?int
    {
        return $this->vigilence;
    }

    public function setVigilence(int $vigilence): self
    {
        $this->vigilence = $vigilence;

        return $this;
    }

    public function getAnalysis(): ?int
    {
        return $this->analysis;
    }

    public function setAnalysis(int $analysis): self
    {
        $this->analysis = $analysis;

        return $this;
    }

    public function getFocus(): ?int
    {
        return $this->focus;
    }

    public function setFocus(int $focus): self
    {
        $this->focus = $focus;

        return $this;
    }

    public function getPlanning(): ?int
    {
        return $this->planning;
    }

    public function setPlanning(int $planning): self
    {
        $this->planning = $planning;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCulture(): ?int
    {
        return $this->culture;
    }

    public function setCulture(int $culture): self
    {
        $this->culture = $culture;

        return $this;
    }

    public function getCommitment(): ?int
    {
        return $this->commitment;
    }

    public function setCommitment(int $commitment): self
    {
        $this->commitment = $commitment;

        return $this;
    }

    public function getReliability(): ?int
    {
        return $this->reliability;
    }

    public function setReliability(int $reliability): self
    {
        $this->reliability = $reliability;

        return $this;
    }

    public function getCoordination(): ?int
    {
        return $this->coordination;
    }

    public function setCoordination(int $coordination): self
    {
        $this->coordination = $coordination;

        return $this;
    }
}
