<?php

namespace App\Entity;

use App\Repository\BodygraphRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\AbstractTrackingListener;

/**
 * @ORM\Entity(repositoryClass=BodygraphRepository::class)
 */
class Bodygraph
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $birthplace;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $birthtime;

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
    private $northNodeDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $southNodeDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $moonDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $mercuryDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $venusDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $marsDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $jupiterDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $saturnDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $uranusDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $neptuneDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $plutoDesign;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $sunPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $earthPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $northNodePersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $southNodePersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $moonPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $mercuryPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $venusPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $marsPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $jupiterPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $saturnPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $uranusPersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $neptunePersonality;

    /**
     * @ORM\ManyToOne(targetEntity=Gate::class)
     */
    private $plutoPersonality;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="reports")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity=Channel::class, inversedBy="bodygraphs")
     */
    private $channels;

    /**
     * @ORM\OneToMany(targetEntity=CenterStatus::class, mappedBy="bodygraph")
     */
    private $centerStatuses;

    /**
     * @ORM\ManyToOne(targetEntity=Authority::class, inversedBy="bodygraphs")
     */
    private $authority;

    /**
     * @ORM\ManyToOne(targetEntity=Profile::class, inversedBy="bodygraphs")
     */
    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity=IncarnationCross::class, inversedBy="bodygraphs")
     */
    private $incarnationCross;

    /**
     * @ORM\ManyToOne(targetEntity=AuraType::class, inversedBy="bodygraphs")
     */
    private $auraType;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=GateActivation::class, mappedBy="bodygraph")
     */
    private $gateActivations;

    /**
     * @ORM\Column(type="integer")
     */
    private $sunDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $earthDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $northNodeDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $southNodeDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $moonDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $mercuryDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $venusDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $marsDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $jupiterDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $saturnDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $uranusDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $neptuneDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $plutoDesignLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $sunPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $earthPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $northNodePersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $southNodePersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $moonPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $mercuryPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $venusPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $marsPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $jupiterPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $saturnPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $uranusPersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $neptunePersonalityLine;

    /**
     * @ORM\Column(type="integer")
     */
    private $plutoPersonalityLine;

    /**
     * @ORM\ManyToMany(targetEntity=TeamPenta::class, mappedBy="bodygraphs")
     */
    private $teamPentas;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bodygraphs")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $claimedByUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timezone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdatetime;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $apiResponse = [];

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->channels = new ArrayCollection();
        $this->centerStatuses = new ArrayCollection();
        $this->gateActivations = new ArrayCollection();
        $this->teamPentas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId() . ' | ' . $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthplace(): string
    {
        return $this->birthplace;
    }

    public function setBirthplace(string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthtime(): ?\DateTimeInterface
    {
        return $this->birthtime;
    }

    public function setBirthtime(\DateTimeInterface $birthtime): self
    {
        $this->birthtime = $birthtime;

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

    public function getNorthNodeDesign(): ?Gate
    {
        return $this->northNodeDesign;
    }

    public function setNorthNodeDesign(?Gate $northNodeDesign): self
    {
        $this->northNodeDesign = $northNodeDesign;

        return $this;
    }

    public function getSouthNodeDesign(): ?Gate
    {
        return $this->southNodeDesign;
    }

    public function setSouthNodeDesign(?Gate $southNodeDesign): self
    {
        $this->southNodeDesign = $southNodeDesign;

        return $this;
    }

    public function getMoonDesign(): ?Gate
    {
        return $this->moonDesign;
    }

    public function setMoonDesign(?Gate $moonDesign): self
    {
        $this->moonDesign = $moonDesign;

        return $this;
    }

    public function getMercuryDesign(): ?Gate
    {
        return $this->mercuryDesign;
    }

    public function setMercuryDesign(?Gate $mercuryDesign): self
    {
        $this->mercuryDesign = $mercuryDesign;

        return $this;
    }

    public function getVenusDesign(): ?Gate
    {
        return $this->venusDesign;
    }

    public function setVenusDesign(?Gate $venusDesign): self
    {
        $this->venusDesign = $venusDesign;

        return $this;
    }

    public function getMarsDesign(): ?Gate
    {
        return $this->marsDesign;
    }

    public function setMarsDesign(?Gate $marsDesign): self
    {
        $this->marsDesign = $marsDesign;

        return $this;
    }

    public function getJupiterDesign(): ?Gate
    {
        return $this->jupiterDesign;
    }

    public function setJupiterDesign(?Gate $jupiterDesign): self
    {
        $this->jupiterDesign = $jupiterDesign;

        return $this;
    }

    public function getSaturnDesign(): ?Gate
    {
        return $this->saturnDesign;
    }

    public function setSaturnDesign(?Gate $saturnDesign): self
    {
        $this->saturnDesign = $saturnDesign;

        return $this;
    }

    public function getUranusDesign(): ?Gate
    {
        return $this->uranusDesign;
    }

    public function setUranusDesign(?Gate $uranusDesign): self
    {
        $this->uranusDesign = $uranusDesign;

        return $this;
    }

    public function getNeptuneDesign(): ?Gate
    {
        return $this->neptuneDesign;
    }

    public function setNeptuneDesign(?Gate $neptuneDesign): self
    {
        $this->neptuneDesign = $neptuneDesign;

        return $this;
    }

    public function getPlutoDesign(): ?Gate
    {
        return $this->plutoDesign;
    }

    public function setPlutoDesign(?Gate $plutoDesign): self
    {
        $this->plutoDesign = $plutoDesign;

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

    public function getNorthNodePersonality(): ?Gate
    {
        return $this->northNodePersonality;
    }

    public function setNorthNodePersonality(?Gate $northNodePersonality): self
    {
        $this->northNodePersonality = $northNodePersonality;

        return $this;
    }

    public function getSouthNodePersonality(): ?Gate
    {
        return $this->southNodePersonality;
    }

    public function setSouthNodePersonality(?Gate $southNodePersonality): self
    {
        $this->southNodePersonality = $southNodePersonality;

        return $this;
    }

    public function getMoonPersonality(): ?Gate
    {
        return $this->moonPersonality;
    }

    public function setMoonPersonality(?Gate $moonPersonality): self
    {
        $this->moonPersonality = $moonPersonality;

        return $this;
    }

    public function getMercuryPersonality(): ?Gate
    {
        return $this->mercuryPersonality;
    }

    public function setMercuryPersonality(?Gate $mercuryPersonality): self
    {
        $this->mercuryPersonality = $mercuryPersonality;

        return $this;
    }

    public function getVenusPersonality(): ?Gate
    {
        return $this->venusPersonality;
    }

    public function setVenusPersonality(?Gate $venusPersonality): self
    {
        $this->venusPersonality = $venusPersonality;

        return $this;
    }

    public function getMarsPersonality(): ?Gate
    {
        return $this->marsPersonality;
    }

    public function setMarsPersonality(?Gate $marsPersonality): self
    {
        $this->marsPersonality = $marsPersonality;

        return $this;
    }

    public function getJupiterPersonality(): ?Gate
    {
        return $this->jupiterPersonality;
    }

    public function setJupiterPersonality(?Gate $jupiterPersonality): self
    {
        $this->jupiterPersonality = $jupiterPersonality;

        return $this;
    }

    public function getSaturnPersonality(): ?Gate
    {
        return $this->saturnPersonality;
    }

    public function setSaturnPersonality(?Gate $saturnPersonality): self
    {
        $this->saturnPersonality = $saturnPersonality;

        return $this;
    }

    public function getUranusPersonality(): ?Gate
    {
        return $this->uranusPersonality;
    }

    public function setUranusPersonality(?Gate $uranusPersonality): self
    {
        $this->uranusPersonality = $uranusPersonality;

        return $this;
    }

    public function getNeptunePersonality(): ?Gate
    {
        return $this->neptunePersonality;
    }

    public function setNeptunePersonality(?Gate $neptunePersonality): self
    {
        $this->neptunePersonality = $neptunePersonality;

        return $this;
    }

    public function getPlutoPersonality(): ?Gate
    {
        return $this->plutoPersonality;
    }

    public function setPlutoPersonality(?Gate $plutoPersonality): self
    {
        $this->plutoPersonality = $plutoPersonality;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Gate[]|null[]
     */
    public function getGates(): array
    {
        $gates = $this->getGatesByPosition();

        $gatesByNumber = [];
        foreach ($gates as $gate) {
            if ($gate instanceof Gate) {
                $gatesByNumber[$gate->getId()] = $gate;
            }
        }

        return $gatesByNumber;
    }

    /**
     * @return ArrayCollection
     */
    public function getGatesAsCollection(): ArrayCollection
    {
        $gateCollection = new ArrayCollection();
        $gates = $this->getGatesByPosition();
        foreach ($gates as $gate) {
            $gateCollection->add($gate);
        }

        return $gateCollection;
    }


    /**
     * @return Gate[]|null[]
     */
    public function getGatesByPosition(): array
    {
        return [
            'sunDesign' => $this->getSunDesign(),
            'earthDesign' => $this->getEarthDesign(),
            'northNodeDesign' => $this->getNorthNodeDesign(),
            'southNodeDesign' => $this->getSouthNodeDesign(),
            'moonDesign' => $this->getMoonDesign(),
            'mercuryDesign' => $this->getMercuryDesign(),
            'venusDesign' => $this->getVenusDesign(),
            'marsDesign' => $this->getMarsDesign(),
            'jupiterDesign' => $this->getJupiterDesign(),
            'saturnDesign' => $this->getSaturnDesign(),
            'uranusDesign' => $this->getUranusDesign(),
            'neptuneDesign' => $this->getNeptuneDesign(),
            'plutoDesign' => $this->getPlutoDesign(),
            'sunPersonality' => $this->getSunPersonality(),
            'earthPersonality' => $this->getEarthPersonality(),
            'northNodePersonality' => $this->getNorthNodePersonality(),
            'southNodePersonality' => $this->getSouthNodePersonality(),
            'moonPersonality' => $this->getMoonPersonality(),
            'mercuryPersonality' => $this->getMercuryPersonality(),
            'venusPersonality' => $this->getVenusPersonality(),
            'marsPersonality' => $this->getMarsPersonality(),
            'jupiterPersonality' => $this->getJupiterPersonality(),
            'saturnPersonality' => $this->getSaturnPersonality(),
            'uranusPersonality' => $this->getUranusPersonality(),
            'neptunePersonality' => $this->getNeptunePersonality(),
            'plutoPersonality' => $this->getPlutoPersonality(),
        ];
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
        }

        return $this;
    }

    public function removeChannel(Channel $channel): self
    {
        $this->channels->removeElement($channel);

        return $this;
    }
    public function getHasGate($number): bool
    {
        $gates = $this->getGates();

        foreach ($gates as $gate) {
            if ($gate->getId() === $number) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * @return Collection<int, Channel>
     */
    public function getChannelsByCenter(Center $center): Collection
    {
        $centerChannels = new ArrayCollection();
        $allChannels = $this->getChannels();

        foreach ($allChannels as $channel) {

            if ($channel->getGateA()->getCenter()[0] === $center || $channel->getGateB()->getCenter()[0] === $center) {
                $centerChannels->add($channel);
            }
        }
        return $centerChannels;
    }


    public function resetChannels(): self
    {
        $this->channels->clear();
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
            $centerStatus->setBodygraph($this);
        }

        return $this;
    }

    public function removeCenterStatus(CenterStatus $centerStatus): self
    {
        if ($this->centerStatuses->removeElement($centerStatus)) {
            // set the owning side to null (unless already changed)
            if ($centerStatus->getBodygraph() === $this) {
                $centerStatus->setBodygraph(null);
            }
        }

        return $this;
    }


    public function getCenterStatusByCenter($center)
    {
        foreach ($this->getCenterStatuses() as $centerStatus) {
            if ($centerStatus->getCenter() === $center) {
                return $centerStatus;
            }
        }

        return NULL;
    }

    public function getAuthority(): ?Authority
    {
        return $this->authority;
    }

    public function setAuthority(?Authority $authority): self
    {
        $this->authority = $authority;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getIncarnationCross(): ?IncarnationCross
    {
        return $this->incarnationCross;
    }

    public function setIncarnationCross(?IncarnationCross $incarnationCross): self
    {
        $this->incarnationCross = $incarnationCross;

        return $this;
    }

    public function getAuraType(): ?AuraType
    {
        return $this->auraType;
    }

    public function setAuraType(?AuraType $auraType): self
    {
        $this->auraType = $auraType;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
            $gateActivation->setBodygraph($this);
        }

        return $this;
    }

    public function removeGateActivation(GateActivation $gateActivation): self
    {
        if ($this->gateActivations->removeElement($gateActivation)) {
            // set the owning side to null (unless already changed)
            if ($gateActivation->getBodygraph() === $this) {
                $gateActivation->setBodygraph(null);
            }
        }

        return $this;
    }

    public function getSunDesignLine(): ?int
    {
        return $this->sunDesignLine;
    }

    public function setSunDesignLine(int $sunDesignLine): self
    {
        $this->sunDesignLine = $sunDesignLine;

        return $this;
    }

    public function getEarthDesignLine(): ?int
    {
        return $this->earthDesignLine;
    }

    public function setEarthDesignLine(int $earthDesignLine): self
    {
        $this->earthDesignLine = $earthDesignLine;

        return $this;
    }

    public function getNorthNodeDesignLine(): ?int
    {
        return $this->northNodeDesignLine;
    }

    public function setNorthNodeDesignLine(int $northNodeDesignLine): self
    {
        $this->northNodeDesignLine = $northNodeDesignLine;

        return $this;
    }

    public function getSouthNodeDesignLine(): ?int
    {
        return $this->southNodeDesignLine;
    }

    public function setSouthNodeDesignLine(int $southNodeDesignLine): self
    {
        $this->southNodeDesignLine = $southNodeDesignLine;

        return $this;
    }

    public function getMoonDesignLine(): ?int
    {
        return $this->moonDesignLine;
    }

    public function setMoonDesignLine(int $moonDesignLine): self
    {
        $this->moonDesignLine = $moonDesignLine;

        return $this;
    }

    public function getMercuryDesignLine(): ?int
    {
        return $this->mercuryDesignLine;
    }

    public function setMercuryDesignLine(int $mercuryDesignLine): self
    {
        $this->mercuryDesignLine = $mercuryDesignLine;

        return $this;
    }

    public function getVenusDesignLine(): ?int
    {
        return $this->venusDesignLine;
    }

    public function setVenusDesignLine(int $venusDesignLine): self
    {
        $this->venusDesignLine = $venusDesignLine;

        return $this;
    }

    public function getMarsDesignLine(): ?int
    {
        return $this->marsDesignLine;
    }

    public function setMarsDesignLine(int $marsDesignLine): self
    {
        $this->marsDesignLine = $marsDesignLine;

        return $this;
    }

    public function getJupiterDesignLine(): ?int
    {
        return $this->jupiterDesignLine;
    }

    public function setJupiterDesignLine(int $jupiterDesignLine): self
    {
        $this->jupiterDesignLine = $jupiterDesignLine;

        return $this;
    }

    public function getSaturnDesignLine(): ?int
    {
        return $this->saturnDesignLine;
    }

    public function setSaturnDesignLine(int $saturnDesignLine): self
    {
        $this->saturnDesignLine = $saturnDesignLine;

        return $this;
    }

    public function getUranusDesignLine(): ?int
    {
        return $this->uranusDesignLine;
    }

    public function setUranusDesignLine(int $uranusDesignLine): self
    {
        $this->uranusDesignLine = $uranusDesignLine;

        return $this;
    }


    public function getNeptuneDesignLine(): ?int
    {
        return $this->neptuneDesignLine;
    }

    public function setNeptuneDesignLine(int $neptuneDesignLine): self
    {
        $this->neptuneDesignLine = $neptuneDesignLine;

        return $this;
    }

    public function getPlutoDesignLine(): ?int
    {
        return $this->plutoDesignLine;
    }

    public function setPlutoDesignLine(int $plutoDesignLine): self
    {
        $this->plutoDesignLine = $plutoDesignLine;

        return $this;
    }


    public function getSunPersonalityLine(): ?int
    {
        return $this->sunPersonalityLine;
    }

    public function setSunPersonalityLine(int $sunPersonalityLine): self
    {
        $this->sunPersonalityLine = $sunPersonalityLine;

        return $this;
    }

    public function getEarthPersonalityLine(): ?int
    {
        return $this->earthPersonalityLine;
    }

    public function setEarthPersonalityLine(int $earthPersonalityLine): self
    {
        $this->earthPersonalityLine = $earthPersonalityLine;

        return $this;
    }

    public function getNorthNodePersonalityLine(): ?int
    {
        return $this->northNodePersonalityLine;
    }

    public function setNorthNodePersonalityLine(int $northNodePersonalityLine): self
    {
        $this->northNodePersonalityLine = $northNodePersonalityLine;

        return $this;
    }

    public function getSouthNodePersonalityLine(): ?int
    {
        return $this->southNodePersonalityLine;
    }

    public function setSouthNodePersonalityLine(int $southNodePersonalityLine): self
    {
        $this->southNodePersonalityLine = $southNodePersonalityLine;

        return $this;
    }

    public function getMoonPersonalityLine(): ?int
    {
        return $this->moonPersonalityLine;
    }

    public function setMoonPersonalityLine(int $moonPersonalityLine): self
    {
        $this->moonPersonalityLine = $moonPersonalityLine;

        return $this;
    }

    public function getMercuryPersonalityLine(): ?int
    {
        return $this->mercuryPersonalityLine;
    }

    public function setMercuryPersonalityLine(int $mercuryPersonalityLine): self
    {
        $this->mercuryPersonalityLine = $mercuryPersonalityLine;

        return $this;
    }

    public function getVenusPersonalityLine(): ?int
    {
        return $this->venusPersonalityLine;
    }

    public function setVenusPersonalityLine(int $venusPersonalityLine): self
    {
        $this->venusPersonalityLine = $venusPersonalityLine;

        return $this;
    }

    public function getMarsPersonalityLine(): ?int
    {
        return $this->marsPersonalityLine;
    }

    public function setMarsPersonalityLine(int $marsPersonalityLine): self
    {
        $this->marsPersonalityLine = $marsPersonalityLine;

        return $this;
    }

    public function getJupiterPersonalityLine(): ?int
    {
        return $this->jupiterPersonalityLine;
    }

    public function setJupiterPersonalityLine(int $jupiterPersonalityLine): self
    {
        $this->jupiterPersonalityLine = $jupiterPersonalityLine;

        return $this;
    }

    public function getSaturnPersonalityLine(): ?int
    {
        return $this->saturnPersonalityLine;
    }

    public function setSaturnPersonalityLine(int $saturnPersonalityLine): self
    {
        $this->saturnPersonalityLine = $saturnPersonalityLine;

        return $this;
    }

    public function getUranusPersonalityLine(): ?int
    {
        return $this->uranusPersonalityLine;
    }

    public function setUranusPersonalityLine(int $uranusPersonalityLine): self
    {
        $this->uranusPersonalityLine = $uranusPersonalityLine;

        return $this;
    }


    public function getNeptunePersonalityLine(): ?int
    {
        return $this->neptunePersonalityLine;
    }

    public function setNeptunePersonalityLine(int $neptunePersonalityLine): self
    {
        $this->neptunePersonalityLine = $neptunePersonalityLine;

        return $this;
    }

    public function getPlutoPersonalityLine(): ?int
    {
        return $this->plutoPersonalityLine;
    }

    public function setPlutoPersonalityLine(int $plutoPersonalityLine): self
    {
        $this->plutoPersonalityLine = $plutoPersonalityLine;

        return $this;
    }

    /**
     * @return Collection<int, TeamPenta>
     */
    public function getTeamPentas(): Collection
    {
        return $this->teamPentas;
    }

    public function addTeamPenta(TeamPenta $teamPenta): self
    {
        if (!$this->teamPentas->contains($teamPenta)) {
            $this->teamPentas[] = $teamPenta;
            $teamPenta->addBodygraph($this);
        }

        return $this;
    }

    public function removeTeamPenta(TeamPenta $teamPenta): self
    {
        if ($this->teamPentas->removeElement($teamPenta)) {
            $teamPenta->removeBodygraph($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getClaimedByUser(): ?User
    {
        return $this->claimedByUser;
    }

    public function setClaimedByUser(?User $claimedByUser): self
    {
        $this->claimedByUser = $claimedByUser;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getBirthdatetime(): ?\DateTimeInterface
    {
        return $this->birthdatetime;
    }

    public function setBirthdatetime(\DateTimeInterface $birthdatetime): self
    {
        $this->birthdatetime = $birthdatetime;

        return $this;
    }

    public function getApiResponse(): ?array
    {
        return $this->apiResponse;
    }

    public function setApiResponse(?array $apiResponse): self
    {
        $this->apiResponse = $apiResponse;

        return $this;
    }
}
