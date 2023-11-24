<?php

namespace App\Controller;

use App\Entity\ChannelProperties;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChannelPropertiesCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return ChannelProperties::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
        ];
    }
    
}
