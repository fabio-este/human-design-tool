<?php

namespace App\Entity;

use App\Repository\AuraTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuraTypeRepository::class)
 * @ORM\Table(
 *      name="aura_type",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(columns={"identifier"})
 *      }
 * )
 */
class AuraType
{
    public const GENERATOR = 'GENERATOR';
    public const MANIFESTOR = 'MANIFESTOR';
    public const MANIFESTING_GENERATOR = 'MANIFESTING_GENERATOR';
    public const PROJECTOR = 'PROJECTOR';
    public const REFLECTOR = 'REFLECTOR';

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
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\OneToMany(targetEntity=Bodygraph::class, mappedBy="auraType")
     */
    private $bodygraphs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $signature;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $signatureDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notSelf;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notSelfDescription;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $strategy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $strategyDescription;

    /**
     * @ORM\OneToMany(targetEntity=TextBlock::class, mappedBy="auraType")
     */
    private $textBlocks;

    public function __construct()
    {
        $this->bodygraphs = new ArrayCollection();
        $this->textBlocks = new ArrayCollection();
    }

    public function __toString(){
        return $this->title;
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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
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
            $bodygraph->setAuraType($this);
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $bodygraph): self
    {
        if ($this->bodygraphs->removeElement($bodygraph)) {
            // set the owning side to null (unless already changed)
            if ($bodygraph->getAuraType() === $this) {
                $bodygraph->setAuraType(null);
            }
        }

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

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getSignatureDescription(): ?string
    {
        return $this->signatureDescription;
    }

    public function setSignatureDescription(?string $signatureDescription): self
    {
        $this->signatureDescription = $signatureDescription;

        return $this;
    }

    public function getNotSelf(): ?string
    {
        return $this->notSelf;
    }

    public function setNotSelf(?string $notSelf): self
    {
        $this->notSelf = $notSelf;

        return $this;
    }

    public function getNotSelfDescription(): ?string
    {
        return $this->notSelfDescription;
    }

    public function setNotSelfDescription(string $notSelfDescription): self
    {
        $this->notSelfDescription = $notSelfDescription;

        return $this;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setStrategy(string $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategyDescription(): ?string
    {
        return $this->strategyDescription;
    }

    public function setStrategyDescription(?string $strategyDescription): self
    {
        $this->strategyDescription = $strategyDescription;

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
            $textBlock->setAuraType($this);
        }

        return $this;
    }

    public function removeTextBlock(TextBlock $textBlock): self
    {
        if ($this->textBlocks->removeElement($textBlock)) {
            // set the owning side to null (unless already changed)
            if ($textBlock->getAuraType() === $this) {
                $textBlock->setAuraType(null);
            }
        }

        return $this;
    }
}
