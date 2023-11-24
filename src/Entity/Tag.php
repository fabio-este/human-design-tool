<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 */
class Tag
{
    /**
     * Hook SoftDeleteable behavior
     * updates deletedAt field
     */
    use SoftDeleteableEntity;

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
     * @ORM\ManyToMany(targetEntity=Bodygraph::class, mappedBy="tags")
     */
    private $reports;

    public function __construct()
    {
        $this->reports = new ArrayCollection();
    }

    public function __toString()
    {
        return '' . $this->getTitle();
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

    /**
     * @return Collection<int, Bodygraph>
     */
    public function getBodygraphs(): Collection
    {
        return $this->reports;
    }

    public function addBodygraph(Bodygraph $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->addTag($this);
        }

        return $this;
    }

    public function removeBodygraph(Bodygraph $report): self
    {
        if ($this->reports->removeElement($report)) {
            $report->removeTag($this);
        }

        return $this;
    }
}
