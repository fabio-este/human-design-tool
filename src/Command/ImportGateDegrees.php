<?php

namespace App\Command;

use App\Entity\Gate;
use App\Repository\GateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportGateDegrees extends Command
{
    private string $csv = "
O_1,Skorpion 13°15‘ - 18°52‘,,,E1_4 = Selbst / G Zentrum
O_2,Stier 13°15 - 18°52‘,,,E1_4 = Selbst / G Zentrum
O_3,Stier 26°22‘ -  2°0‘,,,E1_7 = Sakral Zentrum
O_4,Löwe 18°52‘ - 24°30‘,,,E1_2 = Ajna Zentrum
O_5,,,Schütze 5°45‘ - 11°22‘,E1_7 = Sakral Zentrum
O_6,,,Jungfrau 22°37‘ - 28°15‘,E1_6 = Emotionales Solar Plexus Zentrum
O_7,Löwe 13°15 - 18°52‘,,,E1_4 = Selbst / G Zentrum
O_8,Stier 24°30‘ - 0°7‘,,,E1_3 = Hals Zentrum
O_9,,,Schütze 5°45‘ - 11°22‘,E1_7 = Sakral Zentrum
O_10,,Steinbock 28°15‘ - 3°52‘,,E1_4 = Selbst / G Zentrum
O_11,,,Schütze 22°37‘ - 28°15‘,E1_2 = Ajna Zentrum
O_12,,,Zwilling 22°37‘ - 28°15‘,E1_3 = Hals Zentrum
O_13,Wassermann 13°15 - 18°52‘,,,E1_4 = Selbst / G Zentrum
O_14,Skorpion 24°30‘ - 0°7‘,,,E1_7 = Sakral Zentrum
O_15,,Krebs 28°15‘ - 3°52‘,,E1_4 = Selbst / G Zentrum
O_16,,,Zwilling 5°45‘ - 11°22‘,E1_3 = Hals Zentrum
O_17,,Widder 3°52‘ - 9°30‘,,E1_2 = Ajna Zentrum
O_18,,Waage 3°52‘ - 9°30‘,,E1_8 = Milz Zentrum
O_19,Wassermann 7°37‘ - 13°15‘,,,E1_9 = Wurzel Zentrum
O_20,,,Zwilling 0°7‘ – 5°45‘,E1_3 = Hals Zentrum
O_21,,Widder 9°30‘-15°07‘,,E1_5 = Herz / Ego Zentrum
O_22,,,Fische 17°0‘ - 22°37‘,E1_6 = Emotionales Solar Plexus Zentrum
O_23,Stier 18°52‘ - 24°30‘,,,E1_3 = Hals Zentrum
O_24,Stier 7°37‘ - 13°15‘,,,E1_2 = Ajna Zentrum
O_25,,Widder 28°15‘ - 3°52‘,,E1_4 = Selbst / G Zentrum
O_26,,,Schütze 17°0‘ - 22°37‘,E1_5 = Herz / Ego Zentrum
O_27,Stier 2°0‘ - 7°37‘,,,E1_7 = Sakral Zentrum
O_28,Skorpion 2°0‘ - 7°37‘,,,E1_8 = Milz Zentrum
O_29,Löwe 24°30‘ - 0°7‘,,,E1_7 = Sakral Zentrum
O_30,Wassermann 24°30‘ - 0°7‘,,,E1_6 = Emotionales Solar Plexus Zentrum
O_31,Löwe 2°0‘ - 7°37‘,,,E1_3 = Hals Zentrum
O_32,,Waage 20°45‘-26°22‘,,E1_8 = Milz Zentrum
O_33,Löwe 7°37‘ - 13°15‘,,,E1_3 = Hals Zentrum
O_34,,,Schütze 0°7‘ – 5°45‘,E1_7 = Sakral Zentrum
O_35,,,Zwilling 11°22‘ - 17°0‘,E1_3 = Hals Zentrum
O_36,,,Fische 22°37‘ - 28°15‘,E1_6 = Emotionales Solar Plexus Zentrum
O_37,,,Fische 5°45‘ - 11°22‘,E1_6 = Emotionales Solar Plexus Zentrum
O_38,,Steinbock 9°30‘-15°07‘,,E1_9 = Wurzel Zentrum
O_39,,Krebs 9°30‘-15°07‘,,E1_9 = Wurzel Zentrum
O_40,,,Jungfrau 5°45‘ - 11°22‘,E1_5 = Herz / Ego Zentrum
O_41,Wassermann 2°0‘ - 7°37‘,,,E1_9 = Wurzel Zentrum
O_42,,Widder 20°45‘-26°22‘,,E1_7 = Sakral Zentrum
O_43,Skorpion 18°52‘ - 24°30‘,,,E1_2 = Ajna Zentrum
O_44,Skorpion 7°37‘ - 13°15‘,,,E1_8 = Milz Zentrum
O_45,,,Zwilling 17°0‘ - 22°37‘,E1_3 = Hals Zentrum
O_46,,Waage 28°15‘ - 3°52‘,JUNGFRAU,E1_4 = Selbst / G Zentrum
O_47,,,Jungfrau 17°0‘ - 22°37‘,E1_2 = Ajna Zentrum
O_48,,Waage 9°30‘-15°07‘,,E1_8 = Milz Zentrum
O_49,Wassermann 18°52‘ - 24°30‘,,,E1_6 = Emotionales Solar Plexus Zentrum
O_50,Skorpion 26°22‘ - 2°0‘,,,E1_8 = Milz Zentrum
O_51,,Widder 15°07‘ - 20°45‘,,E1_5 = Herz / Ego Zentrum
O_52,,Krebs 3°52‘ - 9°30‘,,E1_9 = Wurzel Zentrum
O_53,,Krebs 15°07‘ - 20°45‘,,E1_9 = Wurzel Zentrum
O_54,,Steinbock 15°07‘ - 20°45‘,,E1_6 = Emotionales Solar Plexus Zentrum
O_55,,,Fische 0°7‘ – 5°45‘,E1_6 = Emotionales Solar Plexus Zentrum
O_56,Löwe 26°22‘ - 2°0‘,,,E1_3 = Hals Zentrum
O_57,,Waage 15°07‘ - 20°45‘,,E1_8 = Milz Zentrum
O_58,,Steinbock 3°52‘ - 9°30‘,,E1_9 = Wurzel Zentrum
O_59,,,Jungfrau 0°7‘ – 5°45‘,E1_7 = Sakral Zentrum
O_60,Wassermann 26°22‘ - 2°0‘,,,E1_9 = Wurzel Zentrum
O_61,,Steinbock 20°45‘-26°22‘,,E1_1 = Kopf Zentrum
O_62,,Krebs 20°45‘-26°22‘,,E1_3 = Hals Zentrum
O_63,,,Fische 17°0‘ - 22°37‘,E1_1 = Kopf Zentrum
O_64,,,Jungfrau 17°0‘ - 22°37‘,E1_1 = Kopf Zentrum
";

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
            ->setName('hd:import-gate-degrees')
            ->setDescription('Imports gate degrees from CSV.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        print_r($this->csv);

        dump(explode('O_', $this->csv));
        $exploded = explode('O_', $this->csv);

        foreach ($exploded as $line) {
            $gateID = (int) explode(',', $line)[0];
            $gate = $this->gateRepository->find($gateID);

            if ($gate) {
                $fields = explode(',', $line);
                $degrees = '';
                foreach ($fields as $key => $field) {
                    if ($key > 0 && $key < 4 && $field !== "") {
                        $degrees = $field;
                    }
                }

                $degreesArray = array_map('trim', explode('-', trim(preg_replace('/[!^a-zA-Z]/', '', $degrees))));


                dump($degrees);
                dump($degreesArray);
                //dump(explode(',', $line));
            }
            dump($gateID);
            dump($line);
        }


        die;
        $this->gateRepository->find($id);
        $this->entityManager->flush();
        $output->writeln('Importing');


        return 1;
    }
}
