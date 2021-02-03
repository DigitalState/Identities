<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\AssignedRole;

/**
 * Trait Roles
 */
trait Roles
{
    /**
     * Add role
     *
     * @param \App\Entity\AssignedRole $role
     * @return object
     */
    public function addRole(AssignedRole $role)
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    /**
     * Remove role
     *
     * @param \App\Entity\AssignedRole $role
     * @return object
     */
    public function removeRole(AssignedRole $role)
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }
}
