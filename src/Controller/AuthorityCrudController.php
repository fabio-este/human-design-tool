<?php

namespace App\Controller;

use App\Entity\Authority;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuthorityCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Authority::class;
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
            ChoiceField::new('identifier')->setChoices([
                Authority::EGO => Authority::EGO,
                Authority::EMOTIONAL => Authority::EMOTIONAL,
                Authority::SACRAL => Authority::SACRAL,
                Authority::SELF_PROJECTED => Authority::SELF_PROJECTED,
                Authority::SPLEENIC => Authority::SPLEENIC,
                Authority::ENVIRON_MENTAL => Authority::ENVIRON_MENTAL,
                Authority::LUNAR => Authority::LUNAR,
            ]),
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
