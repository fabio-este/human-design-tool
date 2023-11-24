<?php

namespace App\Entity;

use App\Repository\AuthorityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorityRepository::class)
 */
class Authority
{
    public const SACRAL = 'SACRAL';
    public const SPLEENIC = 'SPLEENIC';
    public const EMOTIONAL = 'EMOTIONAL';
    public const EGO = 'EGO';
    public const SELF_PROJECTED  = 'SELF_PROJECTED';
    public const ENVIRON_MENTAL  = 'ENVIRON_MENTAL';
    public const LUNAR = 'LUNAR';

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
     * @ORM\OneToMany(targetEntity=Bodygraph::class, mappedBy="authority")
     */
    private $bodygraphs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtitle;

    public function __construct()
    {
        $this->bodygraphs = new ArrayCollection();
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
            $bodygraph->setAuthority($this);
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $bodygraph): self
    {
        if ($this->bodygraphs->removeElement($bodygraph)) {
            // set the owning side to null (unless already changed)
            if ($bodygraph->getAuthority() === $this) {
                $bodygraph->setAuthority(null);
            }
        }

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

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }
}
