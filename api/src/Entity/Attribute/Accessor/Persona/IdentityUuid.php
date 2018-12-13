<?php

namespace App\Entity\Attribute\Accessor\Persona;

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
    public function setIdentityUuid(?string $identityUuid)
    {
        throw new LogicException('Method call not allowed.');
    }

    /**
     * Get identity uuid
     *
     * @return string
     */
    public function getIdentityUuid(): ?string
    {
        $identity = substr(basename(str_replace('\\', '/', get_class($this))), 0, -7);

        return $this->{'get'.$identity}()->getIdentityUuid();
    }
}
