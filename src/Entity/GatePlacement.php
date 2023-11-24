<?php

namespace App\Entity;

use App\Repository\GatePlacementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GatePlacementRepository::class)
 */
class GatePlacement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class, inversedBy="line")
     */
    private $gate;

    /**
     * @ORM\Column(type="integer")
     */
    private $line;

    /**
     * @ORM\ManyToOne(targetEntity=Bodygraph::class, inversedBy="sunDesignGatePlacement")
     */
    private $bodygraph;

    /**
     * @ORM\ManyToOne(targetEntity=CelestialBody::class, inversedBy="gatePlacements")
     */
    private $celestialBody;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGate(): ?Gate
    {
        return $this->gate;
    }

    public function setGate(?Gate $gate): self
    {
        $this->gate = $gate;

        return $this;
    }

    public function getLine(): ?int
    {
        return $this->line;
    }

    public function setLine(int $line): self
    {
        $this->line = $line;

        return $this;
    }

    public function getBodygraph(): ?Bodygraph
    {
        return $this->bodygraph;
    }

    public function setBodygraph(?Bodygraph $bodygraph): self
    {
        $this->bodygraph = $bodygraph;

        return $this;
    }

    public function getCelestialBody(): ?CelestialBody
    {
        return $this->celestialBody;
    }

    public function setCelestialBody(?CelestialBody $celestialBody): self
    {
        $this->celestialBody = $celestialBody;

        return $this;
    }
}
