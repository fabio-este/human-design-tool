<?php

namespace App\Controller;

use App\Entity\Gate;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GateCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Gate::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('id')->setDisabled(TRUE)->setLabel('Nummer')->setColumns('col-md-1'),
            TextField::new('unicode')->setColumns('col-md-1'),
            TextField::new('title')->setColumns('col-md-5'),
            TextField::new('subtitle')->setValue(' ')->setColumns('col-md-5'),
            //  CKEditorField::new('description'),
            AssociationField::new('opposingGates')->setColumns('col-md-6'),
            AssociationField::new('center')->setColumns('col-md-6'),
            TextField::new('degree_from')->setColumns('col-md-3')->setPermission('ROLE_ADMIN'),
            AssociationField::new('degreeFromSign')->setColumns('col-md-3')->setPermission('ROLE_ADMIN'),
            TextField::new('degree_to')->setColumns('col-md-3')->setPermission('ROLE_ADMIN'),
            AssociationField::new('degreeToSign')->setColumns('col-md-3')->setPermission('ROLE_ADMIN'),
            TextField::new('degreeFromAbsolute')->setColumns('col-md-3')->setPermission('ROLE_ADMIN'),
            TextField::new('degreeToAbsolute')->setColumns('col-md-3')->setPermission('ROLE_ADMIN'),
            BooleanField::new('line6')->setLabel('Linie 6')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            BooleanField::new('line5')->setLabel('Linie 5')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            BooleanField::new('line4')->setLabel('Linie 4')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            BooleanField::new('line3')->setLabel('Linie 3')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            BooleanField::new('line2')->setLabel('Linie 2')->hideOnIndex()->setPermission('ROLE_ADMIN'),
            BooleanField::new('line1')->setLabel('Linie 1')->hideOnIndex()->setPermission('ROLE_ADMIN'),

        ];
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setPaginatorPageSize(64)
            ->showEntityActionsInlined();
    }

    /**
     * @param Actions $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }
}
