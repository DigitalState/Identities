<?php

namespace App\Entity\Attribute\Accessor;

/**
 * Trait Permissions
 */
trait Permissions
{
    /**
     * Set permissions
     *
     * @param array $permissions
     * @return object
     */
    public function setPermissions(?array $permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * Get permissions
     *
     * @return array
     * @throws \OutOfRangeException
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }
}
