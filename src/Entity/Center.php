<?php

namespace App\Entity;

use App\Repository\CenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CenterRepository::class)
 */
class Center
{
    public const CROWN = 'CROWN';
    public const AJNA = 'AJNA';
    public const THROAT = 'THROAT';
    public const SELF = 'SELF';
    public const HEART = 'HEART';
    public const SPLEEN = 'SPLEEN';
    public const SACRAl = 'SACRAL';
    public const SOLARPLEXUS = 'SOLARPLEXUS';
    public const ROOT = 'ROOT';

    public const TYPE_PRESSURE = 'TYPE_PRESSURE';
    public const TYPE_MOTOR = 'TYPE_MOTOR';
    public const TYPE_AWARENESS = 'TYPE_AWARENESS';
    public const TYPE_EXPRESSION = 'TYPE_EXPRESSION';
    public const TYPE_IDENTITY = 'TYPE_IDENTITY';

    public const TYPE_STRINGS = [
        self::TYPE_PRESSURE => 'Druck',
        self::TYPE_MOTOR => 'Motor',
        self::TYPE_AWARENESS => 'Wahrnehmung',
        self::TYPE_EXPRESSION => 'Ausdruck',
        self::TYPE_IDENTITY => 'Identität',
    ];

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() . '';
    }

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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notSelf;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_open;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_undefined;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_defined;

    /**
     * @ORM\ManyToMany(targetEntity=Gate::class, inversedBy="center")
     */
    private $gates;

    /**
     * @ORM\OneToMany(targetEntity=CenterStatus::class, mappedBy="center")
     */
    private $centerStatuses;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $biological;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $type = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $themes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\ManyToMany(targetEntity=Channel::class, mappedBy="Center")
     */
    private $channels;

    public function __construct()
    {
        $this->gates = new ArrayCollection();
        $this->centerStatuses = new ArrayCollection();
        $this->channels = new ArrayCollection();
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

    public function getNotSelf(): ?string
    {
        return $this->notSelf;
    }

    public function setNotSelf(string $notSelf): self
    {
        $this->notSelf = $notSelf;

        return $this;
    }

    public function getDescriptionOpen(): ?string
    {
        return $this->description_open;
    }

    public function setDescriptionOpen(string $description_open): self
    {
        $this->description_open = $description_open;

        return $this;
    }

    public function getDescriptionUndefined(): ?string
    {
        return $this->description_undefined;
    }

    public function setDescriptionUndefined(string $description_undefined): self
    {
        $this->description_undefined = $description_undefined;

        return $this;
    }

    public function getDescriptionDefined(): ?string
    {
        return $this->description_defined;
    }

    public function setDescriptionDefined(string $description_defined): self
    {
        $this->description_defined = $description_defined;

        return $this;
    }

    /**
     * @return Collection<int, Gate>
     */
    public function getGates(): Collection
    {
        return $this->gates;
    }

    public function addGate(Gate $gate): self
    {
        if (!$this->gates->contains($gate)) {
            $this->gates[] = $gate;
        }

        return $this;
    }

    public function removeGate(Gate $gate): self
    {
        $this->gates->removeElement($gate);

        return $this;
    }

    /**
     * @return Collection<int, CenterStatus>
     */
    public function getCenterStatuses(): Collection
    {
        return $this->centerStatuses;
    }

    public function addCenterStatus(CenterStatus $centerStatus): self
    {
        if (!$this->centerStatuses->contains($centerStatus)) {
            $this->centerStatuses[] = $centerStatus;
            $centerStatus->setCenter($this);
        }

        return $this;
    }

    public function removeCenterStatus(CenterStatus $centerStatus): self
    {
        if ($this->centerStatuses->removeElement($centerStatus)) {
            // set the owning side to null (unless already changed)
            if ($centerStatus->getCenter() === $this) {
                $centerStatus->setCenter(null);
            }
        }

        return $this;
    }


    public function getBiological(): ?string
    {
        return $this->biological;
    }

    public function setBiological(?string $biological): self
    {
        $this->biological = $biological;

        return $this;
    }

    public function getType(): ?array
    {
        return $this->type;
    }

    public function setType(?array $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeAsString()
    {
        $imploded = implode(', ', $this->getType());

        foreach (Center::TYPE_STRINGS as $type => $string) {
            $imploded = str_replace($type, $string, $imploded);
        }
        return $imploded;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getThemes(): ?string
    {
        return $this->themes;
    }

    public function setThemes(?string $themes): self
    {
        $this->themes = $themes;

        return $this;
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

    public function isMotorType()
    {
        dump($this->getTitle());

        if ($this->getType() !== NULL && in_array('TYPE_MOTOR', $this->getType())) {
            dump('IS MOTOR');
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return Collection<int, Channel>
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(Channel $channel): self
    {
        if (!$this->channels->contains($channel)) {
            $this->channels[] = $channel;
            $channel->addCenter($this);
        }

        return $this;
    }

    public function removeChannel(Channel $channel): self
    {
        if ($this->channels->removeElement($channel)) {
            $channel->removeCenter($this);
        }

        return $this;
    }

}
