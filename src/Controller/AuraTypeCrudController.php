<?php

namespace App\Controller;

use App\Entity\AuraType;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuraTypeCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return AuraType::class;
    }

    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            ChoiceField::new('identifier')->setChoices([
                AuraType::GENERATOR => AuraType::GENERATOR,
                AuraType::MANIFESTOR => AuraType::MANIFESTOR,
                AuraType::MANIFESTING_GENERATOR => AuraType::MANIFESTING_GENERATOR,
                AuraType::PROJECTOR => AuraType::PROJECTOR,
                AuraType::REFLECTOR => AuraType::REFLECTOR,
            ]),
            TextField::new('subtitle'),
            CKEditorField::new('description'),
            TextField::new('strategy'),
            CKEditorField::new('strategyDescription'),
            TextField::new('signature'),
            CKEditorField::new('signatureDescription'),
            TextField::new('notSelf'),
            CKEditorField::new('notSelfDescription'),
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
