<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\BusinessUnitRole;

/**
 * Trait Roles
 */
trait Roles
{
    /**
     * Add role
     *
     * @param \App\Entity\BusinessUnitRole $role
     * @return object
     */
    public function addRole(BusinessUnitRole $role)
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    /**
     * Remove role
     *
     * @param \App\Entity\BusinessUnitRole $role
     * @return object
     */
    public function removeRole(BusinessUnitRole $role)
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
