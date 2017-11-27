<?php

namespace AppBundle\Entity\Attribute\Accessor;

use LogicException;

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
     * @throws \LogicException
     */
    public function setIdentityUuid($identityUuid)
    {
        throw new LogicException('Method call not allowed.');
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
