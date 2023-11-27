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
use App\Repository\CelestialBodyRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\AstrologyAPI\AstrologyApiClient;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;
use Symfony\Component\Intl\Timezones;

/**
 * Class SendLogService
 *
 * @package App\Service\SendLogService
 */
class BodygraphService
{
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
     * @var CelestialBodyRepository
     */
    protected CelestialBodyRepository $celestialBodyRepository;

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
        BodygraphRepository $bodygraphRepository,
        ChannelRepository $channelRepository,
        CenterRepository $centerRepository,
        IncarnationCrossRepository $incarnationCrossRepository,
        CelestialBodyRepository $celestialBodyRepository,
        AstrologyApiClient $astrologyAPI
    ) {
        $this->bodygraphRepository = $bodygraphRepository;
        $this->channelRepository = $channelRepository;
        $this->centerRepository = $centerRepository;
        $this->incarnationCrossRepository = $incarnationCrossRepository;
        $this->celestialBodyRepository = $celestialBodyRepository;
        $this->entityManager = $entityManager;
        $this->astrologyAPI = $astrologyAPI;
        //$this->sweph = $sweph;
    }

    /**
     * Undocumented function
     *
     * @param Bodygraph $bodygraph
     * @return void
     */
    public function getBodygraphAsCSV(Bodygraph $bodygraph)
    {
        $csv = [];

        // General
        $csv['name']  = $bodygraph->getName();
        $csv['birthdatetime']  = $bodygraph->getBirthdatetime()->format('d.m.Y H:i');
        $csv['birtplace']  = $bodygraph->getBirthplace();
        $csv['copyright']  = $bodygraph->getBirthplace();

        // Aura Type
        $csv['aura_type_title']  = $bodygraph->getAuraType()->getTitle();
        $csv['aura_type_description']  = $bodygraph->getAuraType()->getDescription();
        $csv['aura_type_percentage']  = 'XX%'; // @todo: Aura Type percentage field
        $csv['aura_type_strategy']  =        $bodygraph->getAuraType()->getStrategy();
        $csv['aura_type_strategy_description']  =        $bodygraph->getAuraType()->getStrategyDescription();
        $csv['aura_type_off_self'] = $bodygraph->getAuraType()->getNotSelf();
        $csv['aura_type_off_self_description'] = $bodygraph->getAuraType()->getNotSelfDescription();

        // Authority
        $csv['authority_title']  = $bodygraph->getAuthority()->getTitle();
        $csv['authority_description']  = $bodygraph->getAuthority()->getDescription();

        // Profile
        $csv['profile_title']  = $bodygraph->getProfile()->getTitle();
        $csv['profile']  = $bodygraph->getProfile()->getPersonalityLine() . ' / ' . $bodygraph->getProfile()->getDesignLine();
        $csv['profile_description']  = $bodygraph->getProfile()->getDescription();

        // Centers
        $centersActivations = $bodygraph->getCenterStatuses();

        foreach ($centersActivations as $centersActivation) {
            $activation = $centersActivation->getStatus();
            $center = $centersActivation->getCenter();
            $type = $center->getIdentifier();
            $key = 'center_' . strtolower($type);

            $csv[$key . '_title']  = $center->getTitle();
            $csv[$key . '_subtitle']  = $center->getSubtitle();
            $csv[$key . '_themes'] = $center->getThemes();
            $csv[$key . '_biological'] = $center->getBiological();
            $csv[$key . '_status']  = $activation;
            $csv[$key . '_description'] = $center->getDescription();

            switch ($activation) {
                case CenterStatus::DEFINED:
                    $csv[$key . '_description_definition_specific'] = $center->getDescriptionDefined();
                    break;

                case CenterStatus::UNDEFINED:
                    $csv[$key . '_description_definition_specific'] = $center->getDescriptionUndefined();
                    break;

                case CenterStatus::OPEN:
                    $csv[$key . '_description_definition_specific'] = $center->getDescriptionOpen();
                    break;
            }

            $csv[$key . '_off_self'] = $center->getNotSelf();
        }

        // Gates
        $gates = $bodygraph->getGatesByPosition();

        foreach ($gates as $position => $gate) {
            $key = 'gate_' .
                strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $position));

            $csv[$key . '_number'] = $gate->getId();
            $csv[$key . '_title'] = $gate->getTitle();
            $csv[$key . '_subtitle'] = $gate->getSubtitle();
            $csv[$key . '_unicode'] = $gate->getUnicode();
            $csv[$key . '_description'] = $gate->getDescription();

            $harmonicGates = [];
            $opposingGates = $gate->getOpposingGates();

            foreach ($opposingGates as $gate) {
                $harmonicGates[] = $gate->getId();
            }

            $csv[$key . '_harmonic_gates'] = implode(',', $harmonicGates);
        }

        //CelestialBodies
        $celestialBodies = $this->celestialBodyRepository->findAll();

        foreach ($celestialBodies as $celestialBody) {
            $key = 'celestial_body_' . $celestialBody->getIdentifier();

            $csv[$key . '_title'] = $celestialBody->getTitle();
            $csv[$key . '_subtitle'] = $celestialBody->getSubtitle();
            $csv[$key . '_unicode'] = $celestialBody->getUnicode();
            $csv[$key . '_description'] = $celestialBody->getDescription();
            $csv[$key . '_title_design'] = $celestialBody->getTitleDesign();
            $csv[$key . '_title_personality'] = $celestialBody->getTitlePersonality();
            $csv[$key . '_description_design'] = $celestialBody->getDescriptionDesign();
            $csv[$key . '_description_personality'] = $celestialBody->getDescriptionPersonality();
        }


        // Channels
        $channels = $bodygraph->getChannels();

        foreach ($channels as $channel) {

            $key = 'channel_' . $channel->getGateA()->getId() . '-' . $channel->getGateB()->getId();


            $csv[$key . '_title'] = $channel->getTitle();
            $csv[$key . '_subtitle'] = $channel->getSubtitle();
            $csv[$key . '_themes'] = $channel->getThemes();
            $csv[$key . '_description'] = $channel->getDescription();
            $csv[$key . '_subtitle'] = $channel->getSubtitle();

            $propertiesArray = [];
            $properties = $channel->getProperties();
            foreach ($properties as $property) {
                $propertiesArray[] = $property->getTitle();
            }

            $propertiesString = implode(', ', $propertiesArray);
            $csv[$key . '_properties'] = $propertiesString;
        }

        $csvHeader = [];
        $csvFields = [];
        foreach ($csv as $header => $field) {
            $csvHeader[] = $header;
            $csvFields[] = $field;
        }


        dump($csvHeader);
        dump($csvFields);

        // Write to memory (unless buffer exceeds 2mb when it will write to /tmp)
        $fp = fopen('php://temp', 'w+');

        fputcsv($fp, $csvHeader);
        fputcsv($fp, $csvFields);

        rewind($fp); // Set the pointer back to the start
        $csv_contents = stream_get_contents($fp); // Fetch the contents of our CSV
        fclose($fp); // Close our pointer and free up memory and /tmp space
        // Handle/Output your final sanitised CSV contents
        return $csv_contents;
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
        $apiResponse = $this->astrologyAPI->getWesternHoroscope($day, $month, $year, $hour, $minute, $lat, $lon, $timezoneOffset);

        $apiData = json_decode($apiResponse, TRUE);

        $bodygraph->setApiResponse($apiData);



        dd($apiData);
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
