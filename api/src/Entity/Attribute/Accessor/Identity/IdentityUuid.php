<?php

namespace App\Entity\Attribute\Accessor\Identity;

/**
 * Trait IdentityUuid
 */
trait IdentityUuid
{
    /**
     * Set identity uuid
     *
     * @param string $identityUuid
     * @return object
     */
    public function setIdentityUuid(?string $identityUuid)
    {
    }

    /**
     * Get identity uuid
     *
     * @return string
     */
    public function getIdentityUuid(): ?string
    {
        return $this->uuid;
    }
}
