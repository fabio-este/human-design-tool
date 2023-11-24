<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\User\RolesHelper;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class UserCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /**
     * @var UserPasswordHasherInterface
     */
    protected $hasher;

    /**
     * @var RolesHelper
     */
    protected $rolesHelper;

    /**
     * UserCrudController constructor.
     *
     * @param RolesHelper $rolesHelper
     */
    public function __construct(RolesHelper $rolesHelper)
    {
        $this->rolesHelper = $rolesHelper;
    }

    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id')->hideOnForm();
        $username = TextField::new('username');
        $email = EmailField::new('email')->setRequired(TRUE);
        $enabled = BooleanField::new('enabled')->renderAsSwitch();
        $plainPassword = TextField::new('plainPassword')->setLabel('Plain Password (only fill out to set new password!)');
        $fullname = TextField::new('fullname');
        $roles = ChoiceField::new('roles')
            ->setChoices($this->rolesHelper->getRoles())
            ->allowMultipleChoices()
            ->setPermission('ROLE_SUPER_ADMIN')
            ->setRequired(FALSE);


        switch ($pageName) {
            case Action::DETAIL:
            case Action::INDEX:
                return [$id, $enabled, $username, $fullname, $roles];
            case Action::EDIT:
                return [$enabled, $username, $fullname, $email, $plainPassword, $roles];
            case Action::NEW:
                return [$enabled, $username, $fullname, $email, $plainPassword->setRequired(TRUE), $roles];
        }
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!empty($entityInstance->getPlainPassword())) {
            $encodedPassword = $this->hashPassword($entityInstance, $entityInstance->getPlainPassword());
            $entityInstance->setPassword($encodedPassword);
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $entityInstance
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!empty($entityInstance->getPlainPassword())) {
            $encodedPassword = $this->hashPassword($entityInstance, $entityInstance->getPlainPassword());
            $entityInstance->setPassword($encodedPassword);
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    /**
     * @required
     * @param UserPasswordHasherInterface $hasher
     */
    public function setHasher(UserPasswordHasherInterface $hasher): void
    {
        $this->hasher = $hasher;
    }

    /**
     * @param $user
     * @param $password
     * @return string
     */
    private function hashPassword($user, $password): string
    {
        return $this->hasher->hashPassword($user, $password);
    }
}
