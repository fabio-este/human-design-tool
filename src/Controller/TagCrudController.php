<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Service\User\IndexFilterService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

/**
 * @IsGranted("ROLE_USER")
 */
class TagCrudController extends AbstractCrudController
{

    protected IndexFilterService $indexFilterService;

    /**
     * @param ChannelRepository $channelRepository
     * @param BodygraphService $bodygraphService
     * @param CelestialBodyRepository $celestialBodiesRepository
     * @param TeamPentaService $teamPentaService
     */
    public function __construct(
        IndexFilterService $indexFilterService
    ) {
        $this->indexFilterService = $indexFilterService;
    }

    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            AssociationField::new('user')->setPermission('ROLE_ADMIN')->setColumns('col-md-4'),
        ];
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
}
