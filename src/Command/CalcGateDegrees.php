<?php

namespace App\Command;

use App\Entity\Gate;
use App\Repository\GateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalcGateDegrees extends Command
{


    private GateRepository $gateRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(GateRepository $gateRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct(); #
        $this->gateRepository = $gateRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('hd:calc-gate-degrees');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $gates = $this->gateRepository->findAll();

        foreach ($gates as $gate) {
            $relFrom = $gate->getDegreeFrom();
            $fromSign = $gate->getDegreeFromSign();
            $relFromSign = $fromSign->getDegreeFrom();
            $relTo = $gate->getDegreeTo();
            $toSign = $gate->getDegreeToSign();
            $relToSign = $fromSign->getDegreeTo();

            $relFromArray = preg_replace("/[^0-9]/", "", explode(' ', $relFrom));
            $relFromDec = $this->DMStoDD($relFromArray[0], $relFromArray[1], $relFromArray[2]);

            dump($relFromArray);
            dump($relFromDec);

            $relToArray = preg_replace("/[^0-9]/", "", explode(' ', $relTo));
            $relToDec = $this->DMStoDD($relToArray[0], $relToArray[1], $relToArray[2]);

            dump($relToArray);
            dump($relToDec);



            if ($fromSign === $toSign) {
                $degreeFromAbsolute = $relFromSign + $relFromDec;
                $degreeToAbsolute = $relFromSign + $relToDec;
            } else {
                $degreeFromAbsolute = $relFromSign + $relFromDec;
                $degreeToAbsolute = $relToSign + $relToDec;
            }
            dump(
                $relFrom,
                //  $fromSign,
                $relFromSign,
                $relTo,
                //$toSign,
                $relToSign,
                '----------'
            );
            dump('----------', $degreeFromAbsolute, ' - ', $degreeToAbsolute, '----------');

            $gate->setDegreeFromAbsolute($degreeFromAbsolute);
            $gate->setDegreeToAbsolute($degreeToAbsolute);
            $this->entityManager->persist($gate);
        }
        $this->entityManager->flush();
        $output->writeln('Importing');


        return 1;
    }

    protected function DMStoDD($deg, $min, $sec)
    {

        // Converting DMS ( Degrees / minutes / seconds ) to decimal format
        return $deg + ((($min * 60) + ($sec)) / 3600);
    }
}
