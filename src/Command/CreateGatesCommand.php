<?php

namespace App\Command;

use App\Entity\Gate;
use App\Repository\GateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateGatesCommand extends Command
{

    private GateRepository $gateRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(GateRepository $gateRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct();#
        $this->gateRepository = $gateRepository;
        $this->entityManager = $entityManager;

    }

    protected function configure()
    {
        $this
            ->setName('hd:create-gates')
            ->setDescription('Imports cities from textfile.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $i = 1;die;

        while ($i <= 64) {
            $gate = new Gate();
            $gate->setId($i);
            $gate->setTitle('Gate '. $i);
            $gate->setSubtitle('');
            $gate->setNumber($i);
            $this->gateRepository->add($gate);

            $output->writeln('Creating Gate No. ' . $i);

            $i++;
        }
        $this->entityManager->flush();
        $output->writeln('Importing');


        return 1;
    }
}