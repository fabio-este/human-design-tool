<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 */
class Profile
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Bodygraph::class, mappedBy="profile")
     */
    private $bodygraphs;

    /**
     * @ORM\ManyToOne(targetEntity=Line::class, inversedBy="profiles")
     */
    private $designLine;

    /**
     * @ORM\ManyToOne(targetEntity=Line::class)
     */
    private $personalityLine;

    public function __construct()
    {
        $this->bodygraphs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getProfile() . ' - ' . $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile()
    {
        return $this->getPersonalityLine() . '/' . $this->getDesignLine();
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
            $bodygraph->setProfile($this);
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $bodygraph): self
    {
        if ($this->bodygraphs->removeElement($bodygraph)) {
            // set the owning side to null (unless already changed)
            if ($bodygraph->getProfile() === $this) {
                $bodygraph->setProfile(null);
            }
        }

        return $this;
    }

    public function getDesignLine(): ?Line
    {
        return $this->designLine;
    }

    public function setDesignLine(?Line $designLine): self
    {
        $this->designLine = $designLine;

        return $this;
    }

    public function getPersonalityLine(): ?Line
    {
        return $this->personalityLine;
    }

    public function setPersonalityLine(?Line $personalityLine): self
    {
        $this->personalityLine = $personalityLine;

        return $this;
    }

}
