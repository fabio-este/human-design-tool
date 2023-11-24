<?php

namespace App\Controller;

use App\Entity\AuraType;
use App\Entity\Authority;
use App\Entity\Profile;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProfileCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Profile::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('designLine')->hideOnIndex(),
            AssociationField::new('personalityLine')->hideOnIndex(),
            TextField::new('profile')->setDisabled(TRUE),
            TextField::new('title')
                ->setColumns('col-md-8'),
            CKEditorField::new('description'),
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
            ->showEntityActionsInlined();
    }
}
