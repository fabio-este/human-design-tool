<?php

namespace App\Controller;

use App\Entity\Center;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * [Description CenterCrudController]
 */
class CenterCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Center::class;
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
            TextField::new('subtitle'),
            TextField::new('themes'),
            AssociationField::new('gates'),
            ChoiceField::new('type')->setChoices([
                'Druck' => Center::TYPE_PRESSURE,
                'Motor' => Center::TYPE_MOTOR,
                'Wahrnehmung' => Center::TYPE_AWARENESS,
                'Ausdruck' => Center::TYPE_EXPRESSION,
                'Identität' => Center::TYPE_IDENTITY,
            ])->allowMultipleChoices(),
            ChoiceField::new('identifier')->setChoices([
                Center::CROWN => Center::CROWN,
                Center::AJNA => Center::AJNA,
                Center::THROAT => Center::THROAT,
                Center::SELF => Center::SELF,
                Center::HEART => Center::HEART,
                Center::SPLEEN => Center::SPLEEN,
                Center::SACRAl => Center::SACRAl,
                Center::SOLARPLEXUS => Center::SOLARPLEXUS,
                Center::ROOT => Center::ROOT,
            ]),
            TextField::new('biological'),
            CKEditorField::new('description'),
            CKEditorField::new('description_defined'),
            CKEditorField::new('description_undefined'),
            CKEditorField::new('description_open'),
            CKEditorField::new('not_self'),
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
