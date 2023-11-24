<?php

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

/**
 * IndexFilterService
 */
class IndexFilterService
{

	private $security;

	public function __construct(Security $security)
	{
		$this->security = $security;
	}

	/**
	 * Filter indexQueryBuilder by User, if the logged in User is not an admin!
	 *
	 * @param QueryBuilder $queryBuilder
	 * @return void
	 */
	public function addUserConstraint(QueryBuilder $queryBuilder)
	{
		// returns User object or null if not authenticated
		$user = $this->security->getUser();

		if ($user instanceof User && !$user->hasRoles(['ROLE_ADMIN', 'ROLE_SUPER_ADMIN'])) {
			$queryBuilder->leftJoin('entity.user', 'user')
				->andWhere('entity.user = :user')
				->setParameter('user', $user);
		}

		return $queryBuilder;
	}
}
