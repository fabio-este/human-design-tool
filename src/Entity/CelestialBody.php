<?php

namespace App\Entity;

use App\Repository\CelestialBodyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CelestialBodyRepository::class)
 */
class CelestialBody
{
    public const sun = 'sun';
    public const earth = 'earth';
    public const northNode = 'northNode';
    public const southNode = 'southNode';
    public const moon = 'moon';
    public const mercury = 'mercury';
    public const venus = 'venus';
    public const mars = 'mars';
    public const jupiter = 'jupiter';
    public const saturn = 'saturn';
    public const uranus = 'uranus';
    public const neptune = 'neptune';
    public const pluto = 'pluto';
    public const chiron = 'chiron';
    public const lilith = 'lilith';


    public const activationModeDesign = 'design';
    public const activationModePersonality = 'personality';

    public const asList = [
        self::sun,
        self::earth,
        self::northNode,
        self::southNode,
        self::moon,
        self::mercury,
        self::venus,
        self::mars,
        self::jupiter,
        self::saturn,
        self::uranus,
        self::neptune,
        self::pluto,
        self::chiron,
        self::lilith,
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionDesign;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionPersonality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleDesign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titlePersonality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unicode;

    /**
     * @ORM\OneToMany(targetEntity=GatePlacement::class, mappedBy="celestialBody")
     */
    private $gatePlacements;

    /**
     * @ORM\OneToMany(targetEntity=GateActivation::class, mappedBy="celestialBody")
     */
    private $gateActivations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gatesTitle;

    public function __construct()
    {
        $this->gatePlacements = new ArrayCollection();
        $this->gateActivations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function gettitle(): ?string
    {
        return $this->title;
    }

    public function settitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescriptionDesign(): ?string
    {
        return $this->descriptionDesign;
    }

    public function setDescriptionDesign(?string $descriptionDesign): self
    {
        $this->descriptionDesign = $descriptionDesign;

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

    public function getDescriptionPersonality(): ?string
    {
        return $this->descriptionPersonality;
    }

    public function setDescriptionPersonality(string $descriptionPersonality): self
    {
        $this->descriptionPersonality = $descriptionPersonality;

        return $this;
    }

    public function getTitleDesign(): ?string
    {
        return $this->titleDesign;
    }

    public function setTitleDesign(string $titleDesign): self
    {
        $this->titleDesign = $titleDesign;

        return $this;
    }

    public function getTitlePersonality(): ?string
    {
        return $this->titlePersonality;
    }

    public function setTitlePersonality(string $titlePersonality): self
    {
        $this->titlePersonality = $titlePersonality;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getUnicode(): ?string
    {
        return $this->unicode;
    }

    public function setUnicode(string $unicode): self
    {
        $this->unicode = $unicode;

        return $this;
    }

    /**
     * @return Collection<int, GatePlacement>
     */
    public function getGatePlacements(): Collection
    {
        return $this->gatePlacements;
    }

    public function addGatePlacement(GatePlacement $gatePlacement): self
    {
        if (!$this->gatePlacements->contains($gatePlacement)) {
            $this->gatePlacements[] = $gatePlacement;
            $gatePlacement->setCelestialBody($this);
        }

        return $this;
    }

    public function removeGatePlacement(GatePlacement $gatePlacement): self
    {
        if ($this->gatePlacements->removeElement($gatePlacement)) {
            // set the owning side to null (unless already changed)
            if ($gatePlacement->getCelestialBody() === $this) {
                $gatePlacement->setCelestialBody(null);
            }
        }

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
            $gateActivation->setCelestialBody($this);
        }

        return $this;
    }

    public function removeGateActivation(GateActivation $gateActivation): self
    {
        if ($this->gateActivations->removeElement($gateActivation)) {
            // set the owning side to null (unless already changed)
            if ($gateActivation->getCelestialBody() === $this) {
                $gateActivation->setCelestialBody(null);
            }
        }

        return $this;
    }

    public function getGatesTitle(): ?string
    {
        return $this->gatesTitle;
    }

    public function setGatesTitle(string $gatesTitle): self
    {
        $this->gatesTitle = $gatesTitle;

        return $this;
    }
}
