<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Role;

/**
 * Trait Roles
 */
trait Roles
{
    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     * @return object
     */
    public function addRole(Role $role)
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \AppBundle\Entity\Role $role
     * @return object
     */
    public function removeRole(Role $role)
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
