<?php

namespace App\Service\User;

class RolesHelper {

	/**
	 * @var
	 */
	private $rolesHierarchy;

	/**
	 * @var
	 */
	private $roles = [];

	/**
	 * RolesHelper constructor.
	 *
	 * @param $rolesHierarchy
	 */
	public function __construct($rolesHierarchy) {
		$this->rolesHierarchy = $rolesHierarchy;
	}

	/**
	 * @return array
	 */
	public function getRolesFromHierarchy(): array {
		if (empty($this->roles) && count($this->rolesHierarchy) > 0) {
			foreach ($this->rolesHierarchy as $roleGroup => $rolesFromGroup) {

				if (count($rolesFromGroup) > 0) {
					foreach ($rolesFromGroup as $role) {
						$this->roles[$roleGroup][$role] = $role;
					}
				}
			}
		}

		return $this->roles;
	}

    /**
     * @return array
     */
    public function getRoles(): array {
        if (empty($this->roles) && count($this->rolesHierarchy) > 0) {
            foreach ($this->rolesHierarchy as $roleGroup => $rolesFromGroup) {
                if (count($rolesFromGroup) > 0) {
                    foreach ($rolesFromGroup as $role) {
                        $this->roles[$role] = $role;
                    }
                }
            }
        }

        return $this->roles;
    }
}
