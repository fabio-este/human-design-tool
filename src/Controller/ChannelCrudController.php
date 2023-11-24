<?php

namespace App\Controller;

use App\Entity\Channel;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChannelCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Channel::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('gatesAsString')
                ->setLabel('Kanäle')
                ->setDisabled(),
            TextField::new('subtitle'),
            TextField::new('themes'),
            CKEditorField::new('description'),
            AssociationField::new('properties'),
            AssociationField::new('gates'),
            AssociationField::new('center')
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
            ->showEntityActionsInlined()
            ->setPaginatorPageSize(36)
            ->showEntityActionsInlined();
    }
}
