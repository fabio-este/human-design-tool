<?php

namespace App\Controller;

use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CityCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return City::class;
    }
}
