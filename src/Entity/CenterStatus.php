<?php

namespace App\Entity;

use App\Repository\CenterStatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CenterStatusRepository::class)
 */
class CenterStatus
{
    public const OPEN = 'OPEN';
    public const UNDEFINED = 'UNDEFINED';
    public const DEFINED = 'DEFINED';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Center::class, inversedBy="centerStatuses")
     */
    private $center;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Bodygraph::class, inversedBy="centerStatuses", cascade={"persist"})
     */
    private $bodygraph;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCenter(): ?Center
    {
        return $this->center;
    }

    public function setCenter(?Center $center): self
    {
        $this->center = $center;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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
