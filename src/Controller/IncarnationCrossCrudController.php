<?php

namespace App\Controller;

use App\Entity\IncarnationCross;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IncarnationCrossCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return IncarnationCross::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('gatesAsString')
                ->setLabel('Tore')
                ->setDisabled(TRUE),
            TextField::new('title'),
            CKEditorField::new('description'),
        ];
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->showEntityActionsInlined();
    }
}
