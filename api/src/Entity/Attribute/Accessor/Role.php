<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Role as RoleEntity;

/**
 * Trait Role
 */
trait Role
{
    /**
     * Set role
     *
     * @param \App\Entity\Role $role
     * @return object
     */
    public function setRole(RoleEntity $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \App\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}
