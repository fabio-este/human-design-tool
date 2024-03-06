<?php

namespace App\Entity;

use App\Repository\GateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GateRepository::class)
 */
class Gate
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    /**
     * @ORM\ManyToMany(targetEntity=Channel::class, mappedBy="gates")
     */
    private $channels;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\OneToMany(targetEntity=GatePlacement::class, mappedBy="gate")
     */
    private $gatePlacements;

    /**
     * @ORM\ManyToMany(targetEntity=Gate::class)
     */
    private $opposingGates;

    /**
     * @ORM\ManyToMany(targetEntity=Center::class, mappedBy="gates")
     */
    private $center;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $originalTitle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $line1;

    /**
     * @ORM\Column(type="boolean")
     */
    private $line2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $line3;

    /**
     * @ORM\Column(type="boolean")
     */
    private $line4;

    /**
     * @ORM\Column(type="boolean")
     */
    private $line5;

    /**
     * @ORM\Column(type="boolean")
     */
    private $line6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unicode;

    /**
     * @ORM\OneToMany(targetEntity=GateActivation::class, mappedBy="gate")
     */
    private $gateActivations;

    /**
     * @ORM\OneToMany(targetEntity=TextBlock::class, mappedBy="gate")
     */
    private $textBlocks;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
        $this->gatePlacements = new ArrayCollection();
        $this->opposingGates = new ArrayCollection();
        $this->center = new ArrayCollection();
        $this->gateActivations = new ArrayCollection();
        $this->textBlocks = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId() . ' | ' . $this->getSubtitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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


    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
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
            $channel->addGate($this);
        }

        return $this;
    }

    public function removeChannel(Channel $channel): self
    {
        if ($this->channels->removeElement($channel)) {
            $channel->removeGate($this);
        }

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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
            $gatePlacement->setGate($this);
        }

        return $this;
    }

    public function removeGatePlacement(GatePlacement $gatePlacement): self
    {
        if ($this->gatePlacements->removeElement($gatePlacement)) {
            // set the owning side to null (unless already changed)
            if ($gatePlacement->getGate() === $this) {
                $gatePlacement->setGate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getOpposingGates(): Collection
    {
        return $this->opposingGates;
    }

    public function addOpposingGate(self $opposingGate): self
    {
        if (!$this->opposingGates->contains($opposingGate)) {
            $this->opposingGates[] = $opposingGate;
        }

        return $this;
    }

    public function removeOpposingGate(self $opposingGate): self
    {
        $this->opposingGates->removeElement($opposingGate);

        return $this;
    }

    /**
     * @return Collection<int, Center>
     */
    public function getCenter(): Collection
    {
        return $this->center;
    }

    public function addCenter(Center $center): self
    {
        if (!$this->center->contains($center)) {
            $this->center[] = $center;
            $center->addGate($this);
        }

        return $this;
    }

    public function removeCenter(Center $center): self
    {
        if ($this->center->removeElement($center)) {
            $center->removeGate($this);
        }

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function isLine1(): ?bool
    {
        return $this->line1;
    }

    public function setLine1(bool $line1): self
    {
        $this->line1 = $line1;

        return $this;
    }

    public function isLine2(): ?bool
    {
        return $this->line2;
    }

    public function setLine2(bool $line2): self
    {
        $this->line2 = $line2;

        return $this;
    }

    public function isLine3(): ?bool
    {
        return $this->line3;
    }

    public function setLine3(bool $line3): self
    {
        $this->line3 = $line3;

        return $this;
    }

    public function isLine4(): ?bool
    {
        return $this->line4;
    }

    public function setLine4(bool $line4): self
    {
        $this->line4 = $line4;

        return $this;
    }

    public function isLine5(): ?bool
    {
        return $this->line5;
    }

    public function setLine5(bool $line5): self
    {
        $this->line5 = $line5;

        return $this;
    }

    public function isLine6(): ?bool
    {
        return $this->line6;
    }

    public function setLine6(bool $line6): self
    {
        $this->line6 = $line6;

        return $this;
    }

    public function getUnicode(): ?string
    {
        return $this->unicode;
    }

    public function setUnicode(?string $unicode): self
    {
        $this->unicode = $unicode;

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
            $gateActivation->setGate($this);
        }

        return $this;
    }

    public function removeGateActivation(GateActivation $gateActivation): self
    {
        if ($this->gateActivations->removeElement($gateActivation)) {
            // set the owning side to null (unless already changed)
            if ($gateActivation->getGate() === $this) {
                $gateActivation->setGate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TextBlock>
     */
    public function getTextBlocks(): Collection
    {
        return $this->textBlocks;
    }

    public function addTextBlock(TextBlock $textBlock): self
    {
        if (!$this->textBlocks->contains($textBlock)) {
            $this->textBlocks[] = $textBlock;
            $textBlock->setGate($this);
        }

        return $this;
    }

    public function removeTextBlock(TextBlock $textBlock): self
    {
        if ($this->textBlocks->removeElement($textBlock)) {
            // set the owning side to null (unless already changed)
            if ($textBlock->getGate() === $this) {
                $textBlock->setGate(null);
            }
        }

        return $this;
    }
}
