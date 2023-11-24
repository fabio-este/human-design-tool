<?php 
namespace App\Command;

use App\Entity\City;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CityImportCommand extends Command
{

    private CityRepository $cityRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CityRepository $cityRepository,        EntityManagerInterface $entityManager)
    {
        parent::__construct();#
        $this->cityRepository = $cityRepository;
        $this->entityManager = $entityManager;

    }

    protected function configure()
    {
        $this
            ->setName('hd:import-cities')
            ->setDescription('Imports cities from textfile.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $file = file('worldcities.txt');

        foreach ($file as $line){
            dump($line);

            $parts = explode(':', $line);

            $name = $parts[0];
            $lat = $parts[1];
            $lon = $parts[2];

            $city = new City();
            $city->setName($name);
            $city->setLat($lat);
            $city->setLon($lon);


            $this->cityRepository->add($city);
        }

        $this->entityManager->flush();
        $output->writeln('Importing');


        return 1;
    }
}