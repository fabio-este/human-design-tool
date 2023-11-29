<?php

namespace App\Controller;

use App\Entity\CelestialBody;
use App\Form\CKEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CelestialBodyCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return CelestialBody::class;
    }

    /**
     * @param string $pageName
     * 
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('unicode'),
            TextField::new('title'),
            TextField::new('subtitle'),
            TextField::new('gatesTitle'),
            ChoiceField::new('identifier')->setChoices([
                CelestialBody::sun => CelestialBody::sun,
                CelestialBody::earth => CelestialBody::earth,
                CelestialBody::northNode => CelestialBody::northNode,
                CelestialBody::southNode => CelestialBody::southNode,
                CelestialBody::moon => CelestialBody::moon,
                CelestialBody::mercury => CelestialBody::mercury,
                CelestialBody::venus => CelestialBody::venus,
                CelestialBody::mars => CelestialBody::mars,
                CelestialBody::jupiter => CelestialBody::jupiter,
                CelestialBody::saturn => CelestialBody::saturn,
                CelestialBody::uranus => CelestialBody::uranus,
                CelestialBody::neptune => CelestialBody::neptune,
                CelestialBody::pluto => CelestialBody::pluto,
                CelestialBody::chiron => CelestialBody::chiron, CelestialBody::chiron => CelestialBody::chiron,
            ]),
            CKEditorField::new('description'),

            TextField::new('titleDesign'),
            CKEditorField::new('descriptionDesign'),
            TextField::new('titlePersonality'),
            CKEditorField::new('descriptionPersonality'),
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
