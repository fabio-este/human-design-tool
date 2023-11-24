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
use App\Entity\TeamPenta;
use App\Repository\BodygraphRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SendLogService
 *
 * @package App\Service\SendLogService
 */
class TeamPentaService
{
    /**
     * @var BodygraphRepository
     */
    protected BodygraphRepository $bodygraphRepository;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
 
     */

     //protected SwissEphemeris $sweph;
    public function __construct(EntityManagerInterface $entityManager, BodygraphRepository $bodygraphRepository)
    {
        $this->bodygraphRepository = $bodygraphRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param ArrayCollection $bodygraphs
     */
    public function generateTeamPenta(ArrayCollection $bodygraphs): TeamPenta
    {
        $teamPenta = new TeamPenta();

        foreach($bodygraphs as $bodygraph ){

            if($bodygraph instanceof Bodygraph){

                $teamPenta->addBodygraph($bodygraph);

                if($bodygraph->getHasGate(8)){
                    $teamPenta->setPresence($teamPenta->getPresence()+1);
                }

                if($bodygraph->getHasGate(1)){
                    $teamPenta->setExecution($teamPenta->getExecution()+1);
                }

                if($bodygraph->getHasGate(31)){
                    $teamPenta->setStructure($teamPenta->getStructure()+1);
                }

                if($bodygraph->getHasGate(7)){
                    $teamPenta->setPlanning($teamPenta->getPlanning()+1);
                }

                if($bodygraph->getHasGate(33)){
                    $teamPenta->setVigilence($teamPenta->getVigilence()+1);
                }

                if($bodygraph->getHasGate(7)){
                    $teamPenta->setPlanning($teamPenta->getPlanning()+1);
                }

                if($bodygraph->getHasGate(13)){
                    $teamPenta->setAnalysis($teamPenta->getAnalysis()+1);
                }

                if($bodygraph->getHasGate(2)){
                    $teamPenta->setFocus($teamPenta->getFocus()+1);
                }

                if($bodygraph->getHasGate(14)){
                    $teamPenta->setCapacity($teamPenta->getCapacity()+1);
                }

                if($bodygraph->getHasGate(5)){
                    $teamPenta->setCulture($teamPenta->getCulture()+1);
                }

                if($bodygraph->getHasGate(29)){
                    $teamPenta->setCommitment($teamPenta->getCommitment()+1);
                }  
                
                if($bodygraph->getHasGate(15)){
                    $teamPenta->setReliability($teamPenta->getReliability()+1);
                }

                if($bodygraph->getHasGate(46)){
                    $teamPenta->setCoordination($teamPenta->getCoordination()+1);
                }
            }

        }
        return $teamPenta;
   
    }
}
