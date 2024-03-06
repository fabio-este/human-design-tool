<?php

namespace App\Controller\Admin;

use App\Entity\AuraType;
use App\Entity\Authority;
use App\Entity\Center;
use App\Entity\Channel;
use App\Entity\City;
use App\Entity\Definition;
use App\Entity\Gate;
use App\Entity\IncarnationCross;
use App\Entity\Line;
use App\Entity\Profile;
use App\Entity\Bodygraph;
use App\Entity\CelestialBody;
use App\Entity\ChannelProperties;
use App\Entity\Tag;
use App\Entity\TextBlock;
use App\Entity\User;
use App\Repository\BodygraphRepository;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    private BodygraphRepository $bodygraphRepository;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine, BodygraphRepository $bodygraphRepository)
    {
        $this->doctrine = $doctrine;
        $this->bodygraphRepository = $bodygraphRepository;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $bodygraphs = $this->bodygraphRepository->findAll();

        return $this->render(
            'dashboard/dashboard.html.twig',
            [
                'user' => $user,
                'bodygraphs' => $bodygraphs
            ]
        );
    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Human Design Tools')
            ->setFaviconPath('media/favicon.png');
    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Bodygraphs', 'fa fa-user', Bodygraph::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::section('Entities');
        yield MenuItem::linkToCrud('Himmelskörper',  'fa fa-file-text-o', CelestialBody::class)
            ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Aura Typen', 'fa fa-file-text-o', AuraType::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Authoritäten', 'fa fa-file-text-o', Authority::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Zentren', 'fa fa-file-text-o', Center::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Tore', 'fa fa-file-text-o', Gate::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Kanäle', 'fa fa-file-text-o', Channel::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Kanal-Eigenschaften', 'fa fa-file-text-o', ChannelProperties::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Definitionen', 'fa fa-file-text-o', Definition::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Profile', 'fa fa-file-text-o', Profile::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Linien', 'fa fa-file-text-o', Line::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Inkarnations Kreuze', 'fa fa-file-text-o', IncarnationCross::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::section('Customize');
        yield MenuItem::linkToCrud('Textblocks', 'fa fa-pen', TextBlock::class)
            ->setPermission('ROLE_USER');      
        yield MenuItem::section('Administration')
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class)
            ->setPermission('ROLE_USER');
        yield MenuItem::linkToCrud('Benutzer', 'fa fa-user', User::class)
            ->setPermission('ROLE_ADMIN');
    }

    /**
     * @return Assets
     */
    public function configureAssets(): Assets
    {
        return Assets::new()->addWebpackEncoreEntry('app')->addCssFile('build/css/main.css');;
    }
}
