<?php

namespace App\Service;

/**
 * @copyright 2023 Fabio Stegmeyer <fabio.stegmeyer@gmail.com>
 * @license   Proprietary
 *
 * This Project can not be copied and/or distributed without the express
 * permission of Fabio Stegmeyer
 */

use App\Entity\Bodygraph;
use App\Entity\Center;
use App\Entity\CenterStatus;
use App\Entity\Gate;
use App\Entity\IncarnationCross;
use App\Repository\BodygraphRepository;
use App\Repository\CenterRepository;
use App\Repository\ChannelRepository;
use App\Repository\IncarnationCrossRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\AstrologyAPI\AstrologyApiClient;
use App\Repository\GateRepository;
use DateInterval;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Symfony\Component\Intl\Timezones;

/**
 * Class SendLogService
 *
 * @package App\Service\SendLogService
 */
class BodygraphService
{
    /**
     * @var GateRepository
     */
    protected GateRepository $gateRepository;

    /**
     * @var ChannelRepository
     */
    protected ChannelRepository $channelRepository;

    /**
     * @var CenterRepository
     */
    protected CenterRepository $centerRepository;

    /**
     * @var BodygraphRepository
     */
    protected BodygraphRepository $bodygraphRepository;

    /**
     * @var IncarnationCrossRepository
     */
    protected IncarnationCrossRepository $incarnationCrossRepository;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    /**
     * @var AstrologyApiClient
     */
    protected AstrologyApiClient $astrologyAPI;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ChannelRepository $channelRepository
     * @param CenterRepository $centerRepository
     */

    //protected SwissEphemeris $sweph;
    public function __construct(
        EntityManagerInterface $entityManager,
        GateRepository $gateRepository,
        BodygraphRepository $bodygraphRepository,
        ChannelRepository $channelRepository,
        CenterRepository $centerRepository,
        IncarnationCrossRepository $incarnationCrossRepository,
        AstrologyApiClient $astrologyAPI
    ) {
        $this->bodygraphRepository = $bodygraphRepository;
        $this->channelRepository = $channelRepository;
        $this->gateRepository = $gateRepository;
        $this->centerRepository = $centerRepository;
        $this->incarnationCrossRepository = $incarnationCrossRepository;
        $this->entityManager = $entityManager;
        $this->astrologyAPI = $astrologyAPI;
        //$this->sweph = $sweph;
    }

    public function calculateData(Bodygraph $bodygraph)
    {
        $birthtime = $bodygraph->getBirthtime();
        $birthdate = $bodygraph->getBirthdate();
        $birthplace = $bodygraph->getBirthplace();
        $birthdatetime = $bodygraph->getBirthdatetime();

        $day = $birthdatetime->format('d');
        $month = $birthdatetime->format('m');
        $year = $birthdatetime->format('Y');
        $hour = $birthdatetime->format('H');
        $minute = $birthdatetime->format('i');

        //@todo auto guess location
        $lat = 50.99294743728378;
        $lon = 6.924135363116342;

        $timezone = $bodygraph->getTimezone();


        $timezoneOffset = (int) $this->ch150918__utc_offset_dst($timezone, $birthdatetime);
        dump($day, $month, $year, $hour, $minute, $lat, $lon, $timezoneOffset);
        $personalityApiResponse = $this->astrologyAPI->getWesternHoroscope($day, $month, $year, $hour, $minute, $lat, $lon, $timezoneOffset);

        $personalityApiData = json_decode($personalityApiResponse, TRUE);

        if (isset($personalityApiData['error'])) {
            //@todo make error notification!
            dd('API ERROR!!!', $personalityApiData);
        }

        //   $this->calculateAndSetPersonalityGatesAndLines($bodygraph, $personalityApiData, 'Personality');



        $sundegreeP = $personalityApiData['planets'][0]['full_degree'];







        $designDatetime = clone $bodygraph->getBirthdatetime();

        $secondsDifference = '7810380';
        $designDatetime->sub(new DateInterval('PT' . (int) $secondsDifference . 'S'));
        dump($designDatetime);
        $designDay = $designDatetime->format('d');
        $designMonth = $designDatetime->format('m');
        $designYear = $designDatetime->format('Y');
        $designHour = $designDatetime->format('H');
        $designMinute = $designDatetime->format('i');

        $designApiResponse = $this->astrologyAPI->getWesternHoroscope($designDay, $designMonth, $designYear, $designHour, $designMinute, $lat, $lon, 0);

        $designApiData = json_decode($designApiResponse, TRUE);
        $sundegreeD = $designApiData['planets'][0]['full_degree'];

        dump($designApiData);
        dump($sundegreeP, $sundegreeD);
        dump(360 - ($sundegreeD - $sundegreeP));

        if (isset($designApiData['error'])) {
            //@todo make error notification!
            dd('API ERROR!!!', $designApiData);
        }

        $this->calculateAndSetDesignGatesAndLines($bodygraph, $designApiData);
        dump($bodygraph);

        dd($personalityApiData);
    }

    /**
     * Undocumented function
     *
     * @param Bodygraph $bodygraph
     * @param array $apiData
     * @param string $mode
     * @return void
     */
    protected function calculateAndSetPersonalityGatesAndLines(Bodygraph $bodygraph, array $apiData)
    {
        /**
         * PLANETS
         */
        $planets = $apiData['planets'] ?? FALSE;

        if ($planets) {
            foreach ($planets as $planet) {
                $planetName = $planet['name'] ?? FALSE;
                $degree = $planet['full_degree'] ?? FALSE;

                $gate = $this->gateRepository->findByDegree($degree);

                if ($planetName) {
                    switch ($planetName) {
                        case 'Sun':
                            $bodygraph->setSunPersonality($gate);
                            $bodygraph->setSunPersonalityLine($this->calculateLine($gate, $degree));

                            $earthDegree = $this->calcEarthDegree($degree);
                            $earthGate = $this->gateRepository->findByDegree($earthDegree);

                            $bodygraph->setEarthPersonality($earthGate);
                            $bodygraph->setEarthPersonalityLine($this->calculateLine($earthGate, $earthDegree));
                            break;
                        case 'Node':
                            $bodygraph->setNorthNodePersonality($gate);
                            $bodygraph->setNorthNodePersonalityLine($this->calculateLine($gate, $degree));

                            $southNodeDegree = $this->calcEarthDegree($degree);
                            $southNodeGate = $this->gateRepository->findByDegree($southNodeDegree);

                            $bodygraph->setSouthNodePersonality($southNodeGate);
                            $bodygraph->setSouthNodePersonalityLine($this->calculateLine($southNodeGate, $southNodeDegree));
                            break;
                        case 'Moon':
                            $bodygraph->setMoonPersonality($gate);
                            $bodygraph->setMoonPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Mars':
                            $bodygraph->setMarsPersonality($gate);
                            $bodygraph->setMarsPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Mercury':
                            $bodygraph->setMercuryPersonality($gate);
                            $bodygraph->setMercuryPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Jupiter':
                            $bodygraph->setJupiterPersonality($gate);
                            $bodygraph->setJupiterPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Venus':
                            $bodygraph->setVenusPersonality($gate);
                            $bodygraph->setVenusPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Saturn':
                            $bodygraph->setSaturnPersonality($gate);
                            $bodygraph->setSaturnPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Uranus':
                            $bodygraph->setUranusPersonality($gate);
                            $bodygraph->setUranusPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Neptune':
                            $bodygraph->setNeptunePersonality($gate);
                            $bodygraph->setNeptunePersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Pluto':
                            $bodygraph->setPlutoPersonality($gate);
                            $bodygraph->setPlutoPersonalityLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Chiron':
                            $bodygraph->setChironPersonality($gate);
                            break;
                        case 'Midheaven':
                            $bodygraph->setMidheavenPersonality($gate);
                            break;
                        case 'Part of Fortune':
                            $bodygraph->setPartOfFortunePersonality($gate);
                            break;
                    }
                }
            }
        }

        /**
         * ASCENDANT
         */
        $ascendant = $apiData['ascendant'] ?? FALSE;

        if ($ascendant) {
            $ascendantGate = $this->gateRepository->findByDegree($ascendant);
            $bodygraph->setAscendantPersonality($ascendantGate);
            dump('ascendant');
            dump($ascendantGate->getId());
        }

        /**
         * MIDHEAVEN
         */
        $midheaven = $apiData['midheaven'] ?? FALSE;

        if ($midheaven) {
            $midheavenGate = $this->gateRepository->findByDegree($midheaven);
            $bodygraph->setMidheavenPersonality($midheavenGate);
            dump('midheaven');
            dump($midheavenGate->getId());
        }

        /**
         * LILITH
         */
        $lilith = $apiData['lilith'] ?? FALSE;

        if ($lilith) {
            $lilithDegree = $lilith['full_degree'] ?? FALSE;

            if ($lilithDegree) {
                $lilithGate = $this->gateRepository->findByDegree($lilithDegree);
                $bodygraph->setLilitPersonality($lilithGate);

                dump('lilith');
                dump($lilithGate->getId());
            }
        }


        $bodygraph->setPersonalityAPIResponse($apiData);
    }
    /**
     * Undocumented function
     *
     * @param Bodygraph $bodygraph
     * @param array $apiData
     * @param string $mode
     * @return void
     */
    protected function calculateAndSetDesignGatesAndLines(Bodygraph $bodygraph, array $apiData)
    {
        /**
         * PLANETS
         */
        $planets = $apiData['planets'] ?? FALSE;

        if ($planets) {
            foreach ($planets as $planet) {
                $planetName = $planet['name'] ?? FALSE;
                $degree = $planet['full_degree'] ?? FALSE;

                $gate = $this->gateRepository->findByDegree($degree);

                dump($planetName);
                dump($gate->getId() . ' - ' . $this->calculateLine($gate, $degree));

                if ($planetName) {
                    switch ($planetName) {
                        case 'Sun':
                            $bodygraph->setSunDesign($gate);
                            $bodygraph->setSunDesignLine($this->calculateLine($gate, $degree));

                            $earthDegree = $this->calcEarthDegree($degree);
                            $earthGate = $this->gateRepository->findByDegree($earthDegree);

                            $bodygraph->setEarthDesign($earthGate);
                            $bodygraph->setEarthDesignLine($this->calculateLine($earthGate, $earthDegree));
                            break;
                        case 'Node':
                            $bodygraph->setNorthNodeDesign($gate);
                            $bodygraph->setNorthNodeDesignLine($this->calculateLine($gate, $degree));

                            $southNodeDegree = $this->calcEarthDegree($degree);
                            $southNodeGate = $this->gateRepository->findByDegree($southNodeDegree);

                            $bodygraph->setSouthNodeDesign($southNodeGate);
                            $bodygraph->setSouthNodeDesignLine($this->calculateLine($southNodeGate, $southNodeDegree));
                            break;
                        case 'Moon':
                            $bodygraph->setMoonDesign($gate);
                            $bodygraph->setMoonDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Mars':
                            $bodygraph->setMarsDesign($gate);
                            $bodygraph->setMarsDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Mercury':
                            $bodygraph->setMercuryDesign($gate);
                            $bodygraph->setMercuryDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Jupiter':
                            $bodygraph->setJupiterDesign($gate);
                            $bodygraph->setJupiterDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Venus':
                            $bodygraph->setVenusDesign($gate);
                            $bodygraph->setVenusDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Saturn':
                            $bodygraph->setSaturnDesign($gate);
                            $bodygraph->setSaturnDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Uranus':
                            $bodygraph->setUranusDesign($gate);
                            $bodygraph->setUranusDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Neptune':
                            $bodygraph->setNeptuneDesign($gate);
                            $bodygraph->setNeptuneDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Pluto':
                            $bodygraph->setPlutoDesign($gate);
                            $bodygraph->setPlutoDesignLine($this->calculateLine($gate, $degree));
                            break;
                        case 'Chiron':
                            $bodygraph->setChironDesign($gate);
                            break;
                        case 'Midheaven':
                            $bodygraph->setMidheavenDesign($gate);
                            break;
                        case 'Part of Fortune':
                            $bodygraph->setPartOfFortuneDesign($gate);
                            break;
                    }
                }
            }
        }

        /**
         * ASCENDANT
         */
        $ascendant = $apiData['ascendant'] ?? FALSE;

        if ($ascendant) {
            $ascendantGate = $this->gateRepository->findByDegree($ascendant);
            $bodygraph->setAscendantDesign($ascendantGate);
            dump('ascendant');
            dump($ascendantGate->getId());
        }

        /**
         * MIDHEAVEN
         */
        $midheaven = $apiData['midheaven'] ?? FALSE;

        if ($midheaven) {
            $midheavenGate = $this->gateRepository->findByDegree($midheaven);
            $bodygraph->setMidheavenDesign($midheavenGate);
            dump('midheaven');
            dump($midheavenGate->getId());
        }

        /**
         * LILITH
         */
        $lilith = $apiData['lilith'] ?? FALSE;

        if ($lilith) {
            $lilithDegree = $lilith['full_degree'] ?? FALSE;

            if ($lilithDegree) {
                $lilithGate = $this->gateRepository->findByDegree($lilithDegree);
                $bodygraph->setLilithDesign($lilithGate);

                dump('lilith');
                dump($lilithGate->getId());
            }
        }


        $bodygraph->setDesignAPIResponse($apiData);
    }

    /**
     * @todo: make general gate-line mapping !?!?!?
     *
     * @param Gate $gate
     * @param float $degree
     * @return int
     */
    protected function calculateLine(Gate $gate, float $degree): int
    {
        $from = (float) $gate->getDegreeFromAbsolute();
        $to = (float) $gate->getDegreeToAbsolute();
        $diff = $to - $from;
        $lineWidth = $diff / 6;

        for (
            $i = 1;
            $i <= 6;
            $i++
        ) {
            $fromLine = $from + (($i - 1) * $lineWidth);
            $toLine = $from + ($i * $lineWidth);

            if ($fromLine <= $degree &&  $toLine > $degree) {
                return $i;
            }
        }
        return 0;
    }

    /**
     * Undocumented function
     *
     * @param float $degree
     * @return float
     */
    protected function calcEarthDegree($degree)
    {
        $minus90 = $degree - 180;

        if ($minus90 < 0) {
            return 360 + $minus90;
        }
        return $minus90;
    }


    /**
     * @param Bodygraph $bodygraph
     */
    public function processBodygraph(Bodygraph $bodygraph): void
    {
        $this->determineChannels($bodygraph);
        $this->determineCenters($bodygraph);
        //$this->determinAuraType($bodygraph);
        $this->determineIncarnationCross($bodygraph);
    }

    /**
     * @param Bodygraph $bodygraph
     */
    protected function determineChannels(Bodygraph $bodygraph): void
    {
        $gatesCollection = $bodygraph->getGatesAsCollection();
        $channels = $this->channelRepository->findAll();
        $bodygraph->resetChannels();

        foreach ($channels as $channel) {
            $gateA = $channel->getGateA();
            $gateB = $channel->getGateB();

            if ($gatesCollection->contains($gateA) && $gatesCollection->contains($gateB)) {
                $bodygraph->addChannel($channel);
            }
        }
    }

    /**
     * @param Bodygraph $bodygraph
     */
    protected function determineCenters(Bodygraph $bodygraph): void
    {
        $centers = $this->centerRepository->findAll();
        $activatedGates = $bodygraph->getGates();
        $channels = $bodygraph->getChannels();

        foreach ($centers as $center) {
            $gatesInCenter = $center->getGates();

            $centerStatus = $bodygraph->getCenterStatusByCenter($center);

            $centerStatusNew = FALSE;
            if (!$centerStatus) {
                $centerStatusNew = TRUE;
                $centerStatus = new CenterStatus();
                $centerStatus->setCenter($center);
            }

            $centerStatus->setStatus(CenterStatus::OPEN);

            foreach ($activatedGates as $activatedGate) {
                foreach ($gatesInCenter as $gate) {
                    if ($activatedGate === $gate) {
                        $centerStatus->setStatus(CenterStatus::UNDEFINED);
                    }
                }
            }

            foreach ($channels as $channel) {
                $channelGateA = $channel->getGateA();
                $channelGateB = $channel->getGateB();

                foreach ($gatesInCenter as $gate) {
                    if ($gate === $channelGateA || $gate === $channelGateB) {
                        $centerStatus->setStatus(CenterStatus::DEFINED);
                    }
                }
            }


            if ($centerStatusNew) {
                $bodygraph->addCenterStatus($centerStatus);
                $this->entityManager->getRepository(CenterStatus::class)->add($centerStatus);
            }

            $this->entityManager->flush();
        }
    }

    /**
     * @param Bodygraph $bodygraph
     */
    protected function determineIncarnationCross(Bodygraph $bodygraph): void
    {
        $sunDesign = $bodygraph->getSunDesign();
        $earthDesign = $bodygraph->getEarthDesign();
        $sunPersonality = $bodygraph->getSunPersonality();
        $earthPersonality = $bodygraph->getEarthPersonality();

        if ($sunDesign instanceof Gate && $earthDesign instanceof Gate && $sunPersonality instanceof Gate && $earthPersonality instanceof Gate) {
            $incarnationCross = $this->incarnationCrossRepository->getIncarnationCrossByGates($sunPersonality, $earthPersonality, $sunDesign, $earthDesign);

            if ($incarnationCross === NULL) {

                $incarnationCross = new IncarnationCross();
                $incarnationCross->setSunDesign($sunDesign);
                $incarnationCross->setEarthDesign($earthDesign);
                $incarnationCross->setSunPersonality($sunPersonality);
                $incarnationCross->setEarthPersonality($earthPersonality);
                $incarnationCross->setDescription('');

                $this->entityManager->persist($incarnationCross);
            }

            $bodygraph->setIncarnationCross($incarnationCross);
            $this->entityManager->persist($bodygraph);
            $this->entityManager->flush();
        }
    }

    /**
     *
     * @param Bodygraph $bodygraph
     * @todo logic for aura type
     *
     */
    protected function determinAuraType(Bodygraph $bodygraph)
    {

        $centerStatuses = $bodygraph->getCenterStatuses();

        //   $bodygraph->setAuraType(AuraType::REFLECTOR);

        foreach ($centerStatuses as $centerStatus) {
            dump($centerStatus->getCenter()->getTitle() . ' : ' . $centerStatus->getStatus());
            $center = $centerStatus->getCenter();
            if ($center->getIdentifier() === Center::SACRAl) {
                dump('CHECK FOR MOTOR THROAT CONNECTION!!!');
                dump($center->getIdentifier() . ':' . $center->isMotorType());
                dump($centerStatus->getStatus() === CenterStatus::DEFINED && $center->isMotorType() === TRUE);
                dump($this->centerHasConnectionToThroat($center, $bodygraph));
                if ($centerStatus->getStatus() === CenterStatus::DEFINED && $center->isMotorType() === TRUE && $this->centerHasConnectionToThroat($center, $bodygraph)) {
                    dd('!!!!!!!!!!!! MOTOR CONNECTED TO THROST !!!!!!!!!!!!');
                }
            }
        }

        die;
    }

    /**
     * @param Center $center
     * @param Bodygraph $bodygraph
     * @return bool|void
     */
    protected function centerHasConnectionToThroat(Center $center, Bodygraph $bodygraph)
    {
        $centerChannels = $bodygraph->getChannelsByCenter($center);
        dump($centerChannels);
        foreach ($centerChannels as $channel) {
            $gates = $channel->getGates();
            foreach ($gates as $gate) {
                $gateChannel = $gate->getChannels();
                dump($gateChannel);
            }

            if ($channel->getCenter()->getIdentifier() === Center::THROAT) {
                return TRUE;
            } else {
                $this->centerHasConnectionToThroat($center, $bodygraph);
            }
        }
    }

    protected function getUTCOffset($timezone, $birthdatetime)
    {
        $current   = timezone_open($timezone);
        $utcTime  = new \DateTime($birthdatetime->format(), new \DateTimeZone('UTC'));
        $offsetInSecs =  $current->getOffset($utcTime);
        $hoursAndSec = gmdate('H:i', abs($offsetInSecs));
        return stripos($offsetInSecs, '-') === false ? "+{$hoursAndSec}" : "-{$hoursAndSec}";
    }

    protected function    ch150918__utc_offset_dst($time_zone = 'Europe/Berlin', $datetime = 'now')
    {

        // Set UTC as default time zone.
        date_default_timezone_set('UTC');

        if ($datetime instanceof DateTimeInterface) {
            $utc = new DateTime($datetime->format('Y-m-d H:i:s'));
        } else {
            $utc = new DateTime();
        }


        // Calculate offset.
        $current   = timezone_open($time_zone);
        $offset_s  = timezone_offset_get($current, $utc); // seconds
        $offset_h  = $offset_s / (60 * 60); // hours

        // Prepend “+” when positive
        $offset_h  = (string) $offset_h;
        if (
            strpos($offset_h, '-') === FALSE
        ) {
            $offset_h = '+' . $offset_h; // prepend +
        }

        return $offset_h;
    }
}
