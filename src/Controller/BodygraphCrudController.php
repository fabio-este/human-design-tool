<?php

namespace App\Controller;

use App\Entity\Bodygraph;
use App\Entity\CelestialBody;
use App\Entity\GateActivation;
use App\Repository\CelestialBodyRepository;
use App\Repository\ChannelRepository;
use App\Service\BodygraphService;
use App\Service\TeamPentaService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\HttpFoundation\Response;

class BodygraphCrudController extends AbstractCrudController
{
    protected ChannelRepository $channelRepository;

    protected BodygraphService $bodygraphService;

    protected TeamPentaService $teamPentaService;

    protected CelestialBodyRepository $celestialBodiesRepository;

    /**
     * @param ChannelRepository $channelRepository
     * @param BodygraphService $bodygraphService
     * @param CelestialBodyRepository $celestialBodiesRepository
     * @param TeamPentaService $teamPentaService
     */
    public function __construct(ChannelRepository $channelRepository, BodygraphService $bodygraphService, CelestialBodyRepository $celestialBodiesRepository, TeamPentaService $teamPentaService)
    {
        $this->channelRepository = $channelRepository;
        $this->bodygraphService = $bodygraphService;
        $this->teamPentaService = $teamPentaService;
        $this->celestialBodiesRepository = $celestialBodiesRepository;
    }

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Bodygraph::class;
    }

    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('birthplace'),
            DateField::new('birthdate'),
            TimeField::new('birthtime'),
            AssociationField::new('sunDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('sunDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('sunPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('sunPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('earthDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('earthDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('earthPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('earthPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('northNodeDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('northNodeDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('northNodePersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('northNodePersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('southNodeDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('southNodeDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('southNodePersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('southNodePersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('moonDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('moonDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('moonPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('moonPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('mercuryDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('mercuryDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('mercuryPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('mercuryPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('venusDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('venusDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('venusPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('venusPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('marsDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('marsDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('marsPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('marsPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('jupiterDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('jupiterDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('jupiterPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('jupiterPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('saturnDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('saturnDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('saturnPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('saturnPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('uranusDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('uranusDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('uranusPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('uranusPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('neptuneDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('neptuneDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('neptunePersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('neptunePersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('plutoDesign')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('plutoDesignLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('plutoPersonality')->setColumns('col-md-4')->hideOnIndex(),
            ChoiceField::new('plutoPersonalityLine')->setColumns('col-md-2')->hideOnIndex()
            ->setChoices([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6]),
            AssociationField::new('auraType'),
            AssociationField::new('authority'),
            AssociationField::new('profile'),
            ImageField::new('image')
                ->setBasePath('img/graphs')
                ->setUploadDir('public/img/graphs'),

            AssociationField::new('tags'),
        ];
    }

    /**
     * @param AdminContext $context
     * @return Response+
     */
    public function displayReportAction(AdminContext $context): Response
    {
        $bodygraph = $context->getEntity()->getInstance();
        $bodygraphImage = $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/graphs/' . $bodygraph->getImage());

        return $this->render('bodygraph/displayReport.html.twig', [
            'bodygraph' => $bodygraph,
            'bodygraphImage' => $bodygraphImage,
            'celestialBodies' => $this->celestialBodiesRepository->getCelestialBodiesByIdentifier()
        ]);
    }


    /**
     * @param AdminContext $context
     * @return Response
     */
    public function displayTeamPentaAction(BatchActionDto $batchActionDto): Response
    {
        $className = $batchActionDto->getEntityFqcn();
        $entityManager = $this->container->get('doctrine')->getManagerForClass($className);


        $bodygraphs = new ArrayCollection();
        foreach ($batchActionDto->getEntityIds() as $id) {
            $bodygraph = $entityManager->find($className, $id);
            $bodygraphs[$id] = $bodygraph;
        }

        $teamPenta = $this->teamPentaService->generateTeamPenta($bodygraphs);

        return $this->render('bodygraph/displayTeamPenta.html.twig', [
            'teamPenta' => $teamPenta
        ]);
    }


    /**
     * @param string $path
     * @return string
     */
    private function imageToBase64(string $path): string
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    /**
     * @param string $entityFqcn
     * 
     * @return [type]
     */
    public function createEntity(string $entityFqcn)
    {
        $bodygraph = new $entityFqcn();

        foreach(CelestialBody::asList as $celestialBodyIdentifier){
            $gateActivation = new GateActivation();
            $gateActivation->setBodygraph($bodygraph);
            $gateActivation->setCelestialBody($this->celestialBodiesRepository->getCelestialBodyByIdentifier($celestialBodyIdentifier));
            $gateActivation->setMode(CelestialBody::activationModeDesign);
        }

        foreach(CelestialBody::asList as $celestialBody){
            $gateActivation = new GateActivation();
            $gateActivation->setBodygraph($bodygraph);
            $gateActivation->setCelestialBody($this->celestialBodiesRepository->getCelestialBodyByIdentifier($celestialBodyIdentifier));
            $gateActivation->setMode(CelestialBody::activationModePersonality);
        }

        return $bodygraph;
    }


    /**
     * @param EntityManagerInterface $entityManager
     * @param $bodygraph
     */
    public function updateEntity(EntityManagerInterface $entityManager, $bodygraph): void
    {
        // Modify the entity before it's persisted
        if ($bodygraph instanceof Bodygraph) {
            $this->bodygraphService->processBodygraph($bodygraph);
        }
        parent::updateEntity($entityManager, $bodygraph);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $bodygraph
     */
    public function persistEntity(EntityManagerInterface $entityManager, $bodygraph): void
    {
        // Modify the entity before it's persisted
        if ($bodygraph instanceof Bodygraph) {
            $this->bodygraphService->processBodygraph($bodygraph);
        }
        parent::persistEntity($entityManager, $bodygraph);
    }

    /**
     * @param Actions $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        $displayReport = Action::new('displayReport', '', 'fa fa-file')
            ->linkToCrudAction('displayReportAction');


            $displayTeamPenta = Action::new('displayTeamPenta', '', 'fa fa-users')
            ->linkToCrudAction('displayTeamPentaAction')
            ->addCssClass('btn btn-primary');


        return $actions
            ->add(Crud::PAGE_DETAIL, $displayReport)
            ->add(Crud::PAGE_EDIT, $displayReport)
            ->add(Crud::PAGE_INDEX, $displayReport)
            ->addBatchAction($displayTeamPenta);
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

    /**
     * @param Assets $assets
     * 
     * @return Assets
     */
    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addWebpackEncoreEntry('js/bodygraph');
    }
}
