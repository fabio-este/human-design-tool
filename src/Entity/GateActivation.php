<?php

namespace App\Entity;

use App\Repository\GateActivationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GateActivationRepository::class)
 */
class GateActivation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CelestialBody::class, inversedBy="gateActivations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $celestialBody;

    /**
     * @ORM\ManyToOne(targetEntity=Line::class, inversedBy="gateActivations")
     */
    private $line;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class, inversedBy="gateActivations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mode;

    /**
     * @ORM\ManyToOne(targetEntity=Bodygraph::class, inversedBy="gateActivations")
     */
    private $bodygraph;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLine(): ?Line
    {
        return $this->line;
    }

    public function setLine(?Line $line): self
    {
        $this->line = $line;

        return $this;
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

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): self
    {
        $this->mode = $mode;

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
}
