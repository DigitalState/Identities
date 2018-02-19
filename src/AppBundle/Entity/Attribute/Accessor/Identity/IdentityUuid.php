<?php

namespace AppBundle\Entity\Attribute\Accessor\Identity;

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
    public function setIdentityUuid($identityUuid)
    {
    }

    /**
     * Get identity uuid
     *
     * @return string
     */
    public function getIdentityUuid()
    {
        return $this->uuid;
    }
}
