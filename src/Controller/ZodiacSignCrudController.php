<?php

namespace App\Controller;

use App\Entity\ZodiacSign;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ZodiacSignCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ZodiacSign::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
