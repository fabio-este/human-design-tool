<?php

namespace App\Controller;

use App\Entity\Bodygraph;
use App\Entity\CelestialBody;
use App\Entity\GateActivation;
use App\Form\BirthplaceField;
use App\Repository\BodygraphRepository;
use App\Repository\CelestialBodyRepository;
use App\Repository\ChannelRepository;
use App\Service\BodygraphService;
use App\Service\HDAPIService;
use App\Service\TeamPentaService;
use App\Service\User\IndexFilterService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BodygraphCrudController extends AbstractCrudController
{
    protected ChannelRepository $channelRepository;

    protected BodygraphService $bodygraphService;

    protected TeamPentaService $teamPentaService;

    protected IndexFilterService $indexFilterService;

    protected CelestialBodyRepository $celestialBodiesRepository;

    protected BodygraphRepository $bodygraphRepository;

    protected HDAPIService $api;
    protected HttpClientInterface $client;

    /**
     * @param ChannelRepository $channelRepository
     * @param BodygraphService $bodygraphService
     * @param CelestialBodyRepository $celestialBodiesRepository
     * @param Bodygraph $bodygraphRepository
     * @param TeamPentaService $teamPentaService
     * @param HDAPIService $api
     */
    public function __construct(
        ChannelRepository $channelRepository,
        BodygraphService $bodygraphService,
        CelestialBodyRepository $celestialBodiesRepository,
        TeamPentaService $teamPentaService,
        IndexFilterService $indexFilterService,
        BodygraphRepository $bodygraphRepository,
        HDAPIService $api,
        HttpClientInterface $client
    ) {
        $this->channelRepository = $channelRepository;
        $this->bodygraphService = $bodygraphService;
        $this->teamPentaService = $teamPentaService;
        $this->indexFilterService = $indexFilterService;
        $this->celestialBodiesRepository = $celestialBodiesRepository;
        $this->bodygraphRepository = $bodygraphRepository;
        $this->api = $api;
        $this->client = $client;
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
        //@todo rewrite to yield and make array $celestialBodies = ['sun', 'earth', ...]
        yield TextField::new('name')->setColumns('col-md-3');
        yield BirthplaceField::new('birthplace')->setColumns('col-md-3');
        yield DateField::new('birthdate')->setColumns('col-md-3');
        yield TimeField::new('birthtime')->setColumns('col-md-3');

        $celestialBodies = ['sun', 'earth', 'northNode', 'southNode', 'moon', 'mercury', 'venus', 'mars', 'jupiter', 'saturn', 'uranus', 'neptune', 'pluto'];

        foreach ($celestialBodies as $celestialBody) {
            yield AssociationField::new($celestialBody . 'Design')
                ->addCssClass('celestial-body-field celestial-body-field-' . $celestialBody)
                ->setColumns('col-md-4')
                ->hideOnIndex();
            yield ChoiceField::new($celestialBody . 'DesignLine')
                ->setColumns('col-md-2')
                ->hideOnIndex()
                ->setRequired(FALSE)
                ->setChoices([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6]);
            yield AssociationField::new($celestialBody . 'Personality')
                ->addCssClass('celestial-body-field celestial-body-field-' . $celestialBody)
                ->setColumns('col-md-4')

                ->hideOnIndex();
            yield ChoiceField::new($celestialBody . 'PersonalityLine')
                ->setColumns('col-md-2')
                ->hideOnIndex()
                ->setRequired(FALSE)
                ->setChoices([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6]);
        }

        yield AssociationField::new('auraType')->setColumns('col-md-4');
        yield AssociationField::new('authority')->setColumns('col-md-4');
        yield AssociationField::new('profile')->setColumns('col-md-4');
        yield ImageField::new('image')
            ->setBasePath('img/graphs')
            ->setUploadDir('public/img/graphs')
            ->setColumns('col-md-4');
        yield AssociationField::new('tags')->setColumns('col-md-4');
        yield AssociationField::new('user')->setPermission('ROLE_ADMIN')->setColumns('col-md-4');
        yield AssociationField::new('claimedByUser')->setRequired(FALSE)->setColumns('col-md-6');
        yield TextField::new('urlHash')->hideOnIndex()->setRequired(FALSE)->setDisabled()->setColumns('col-md-6');
    }

    /**
     * @Route("/report", name="report")
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
     * @Route("/report/{hash}", name="report_external")
     * @return Response+
     */
    public function displayReportExternalAction(string $hash)
    {
        $bodygraph = $this->bodygraphRepository->findOneByUrlHash($hash);
        $bodygraphImage = $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/graphs/' . $bodygraph->getImage());

        return $this->render('bodygraph/displayReportExternal.html.twig', [
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
     * @Route("/api/birthplace/search/", methods="GET", name="api_birthplace_search")
     */
    public function birthplaceSearch(Request $request)
    {

        $query = $request->query->get('q');

        $results = $this->api->findTimezoneCall($query);

    
        $response = new Response(
            json_encode($results),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );

        $response->send();
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

        foreach (CelestialBody::asList as $celestialBodyIdentifier) {
            $gateActivation = new GateActivation();
            $gateActivation->setBodygraph($bodygraph);
            $gateActivation->setCelestialBody($this->celestialBodiesRepository->getCelestialBodyByIdentifier($celestialBodyIdentifier));
            $gateActivation->setMode(CelestialBody::activationModeDesign);
        }

        foreach (CelestialBody::asList as $celestialBody) {
            $gateActivation = new GateActivation();
            $gateActivation->setBodygraph($bodygraph);
            $gateActivation->setCelestialBody($this->celestialBodiesRepository->getCelestialBodyByIdentifier($celestialBodyIdentifier));
            $gateActivation->setMode(CelestialBody::activationModePersonality);
        }


        if ($bodygraph->getUrlHash() === NULL) {
            $this->bodygraphService->calcUrlHash($bodygraph);
        }

        return $bodygraph;
    }

    /**
     * Overwrite createIndexQueryBuilder to add user constraints
     *
     * @param SearchDto $searchDto
     * @param EntityDto $entityDto
     * @param FieldCollection $fields
     * @param FilterCollection $filters
     * @return QueryBuilder
     */
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $response = $this->container->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        return $this->indexFilterService->addUserConstraint($response);
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

        if ($bodygraph->getUrlHash() === NULL) {
            $this->bodygraphService->calcUrlHash($bodygraph);
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
        if ($bodygraph->getUrlHash() === '') {
            $this->bodygraphService->calcUrlHash($bodygraph);
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

        $displayReportExternal = Action::new('displayReportExternal', '', 'fas fa-file-export')
            ->linkToRoute('report_external', fn (Bodygraph $entity) => ['hash' => $entity->getUrlHash()]);

        $displayTeamPenta = Action::new('displayTeamPenta', '', 'fa fa-users')
            ->linkToCrudAction('displayTeamPentaAction')
            ->addCssClass('btn btn-primary');

        return $actions
            ->add(Crud::PAGE_DETAIL, $displayReport)
            ->add(Crud::PAGE_EDIT, $displayReport)
            ->add(Crud::PAGE_INDEX, $displayReport)
            ->add(Crud::PAGE_DETAIL, $displayReportExternal)
            ->add(Crud::PAGE_EDIT, $displayReportExternal)
            ->add(Crud::PAGE_INDEX, $displayReportExternal)
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
    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addWebpackEncoreEntry('js/birthplace-autosuggest');
    }
}
