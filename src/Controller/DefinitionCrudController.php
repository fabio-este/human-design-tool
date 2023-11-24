<?php

namespace App\Controller;

use App\Entity\Definition;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DefinitionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Definition::class;
    }
}
