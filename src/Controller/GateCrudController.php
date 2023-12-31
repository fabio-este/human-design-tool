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
            NumberField::new('id')->setDisabled(TRUE)->setLabel('Tor-Nummer'),
            TextField::new('title')->setColumns('col-md-12'),
            TextField::new('unicode')->setColumns('col-md-1'),
            TextField::new('subtitle')->setValue(' ')->setColumns('col-md-11'),
            CKEditorField::new('description'),
            AssociationField::new('opposingGates'),
            AssociationField::new('center'),
            BooleanField::new('line6')->setLabel('Linie 6')->hideOnIndex(),
            BooleanField::new('line5')->setLabel('Linie 5')->hideOnIndex(),
            BooleanField::new('line4')->setLabel('Linie 4')->hideOnIndex(),
            BooleanField::new('line3')->setLabel('Linie 3')->hideOnIndex(),
            BooleanField::new('line2')->setLabel('Linie 2')->hideOnIndex(),
            BooleanField::new('line1')->setLabel('Linie 1')->hideOnIndex(),

        ];
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud    {
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
