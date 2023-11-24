<?php

namespace App\Entity;

use App\Repository\IncarnationCrossRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IncarnationCrossRepository::class)
 */
class IncarnationCross
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Bodygraph::class, mappedBy="incarnationCross")
     */
    private $bodygraphs;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $sunDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $earthDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $sunPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $earthPersonality;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->gates = new ArrayCollection();
        $this->bodygraphs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getDescription() . '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $bodygraph->setIncarnationCross($this);
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $bodygraph): self
    {
        if ($this->bodygraphs->removeElement($bodygraph)) {
            // set the owning side to null (unless already changed)
            if ($bodygraph->getIncarnationCross() === $this) {
                $bodygraph->setIncarnationCross(null);
            }
        }

        return $this;
    }

    public function getSunDesign(): ?Gate
    {
        return $this->sunDesign;
    }

    public function setSunDesign(?Gate $sunDesign): self
    {
        $this->sunDesign = $sunDesign;

        return $this;
    }

    public function getEarthDesign(): ?Gate
    {
        return $this->earthDesign;
    }

    public function setEarthDesign(?Gate $earthDesign): self
    {
        $this->earthDesign = $earthDesign;

        return $this;
    }

    public function getSunPersonality(): ?Gate
    {
        return $this->sunPersonality;
    }

    public function setSunPersonality(?Gate $sunPersonality): self
    {
        $this->sunPersonality = $sunPersonality;

        return $this;
    }

    public function getEarthPersonality(): ?Gate
    {
        return $this->earthPersonality;
    }

    public function setEarthPersonality(?Gate $earthPersonality): self
    {
        $this->earthPersonality = $earthPersonality;

        return $this;
    }

    public function getGatesAsString(){
        return $this->getSunPersonality()->getId() . '/' .$this->getEarthPersonality()->getId() . ' | ' . $this->getSunDesign()->getId() . '/' .$this->getEarthDesign()->getId();
    }
}
