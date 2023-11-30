<?php

namespace App\Entity;

use App\Repository\ChannelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChannelRepository::class)
 */
class Channel
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
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Gate::class, inversedBy="channels")
     */
    private $gates;

    /**
     * @ORM\ManyToMany(targetEntity=Bodygraph::class, mappedBy="channels")
     */
    private $bodygraphs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $themes;

    /**
     * @ORM\ManyToMany(targetEntity=Center::class, inversedBy="channels")
     */
    private $center;

    /**
     * @ORM\ManyToMany(targetEntity=ChannelProperties::class, inversedBy="channels")
     */
    private $properties;

    public function __construct()
    {
        $this->gates = new ArrayCollection();
        $this->bodygraphs = new ArrayCollection();
        $this->center = new ArrayCollection();
        $this->properties = new ArrayCollection();
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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

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

    public function getGateA(): ?Gate
    {
        return $this->gates[0] ?? NULL;
    }

    public function getGateB(): ?Gate
    {
        return $this->gates[1] ?? NULL;
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
            $bodygraph->addChannel($this);
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $bodygraph): self
    {
        if ($this->bodygraphs->removeElement($bodygraph)) {
            $bodygraph->removeChannel($this);
        }

        return $this;
    }

    public function gatesAsString()
    {
        return $this->getGateA()->getId() . ' - ' . $this->getGateB()->getId();
    }

    public function getThemes(): ?string
    {
        return $this->themes;
    }

    public function setThemes(string $themes): self
    {
        $this->themes = $themes;

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
        }

        return $this;
    }

    public function removeCenter(Center $center): self
    {
        $this->center->removeElement($center);

        return $this;
    }

    /**
     * @return Collection<int, ChannelProperties>
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(ChannelProperties $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
        }

        return $this;
    }

    public function removeProperty(ChannelProperties $property): self
    {
        $this->properties->removeElement($property);

        return $this;
    }

    public function isConnectedToThroat()
    {
        $gates = $this->getGates();
        dump('123123');


        foreach ($gates as $gate) {
            dump($gate->getId());

            $center = $gate->getCenter()[0];

            if ($center instanceof Center &&  $center->getIdentifier() === Center::THROAT) {
                return TRUE;
            }
        }

        return FALSE;
    }
}
