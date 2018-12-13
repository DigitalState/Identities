<?php

namespace App\Entity\Attribute\Accessor\Persona;

use LogicException;

/**
 * Trait Identity
 */
trait Identity
{
    /**
     * Set identity
     *
     * @param string $identity
     * @return object
     * @throws \LogicException
     */
    public function setIdentity(?string $identity)
    {
        throw new LogicException('Method call not allowed.');
    }

    /**
     * Get identity
     *
     * @return string
     */
    public function getIdentity(): ?string
    {
        $identity = substr(basename(str_replace('\\', '/', get_class($this))), 0, -7);

        return $this->{'get'.$identity}()->getIdentity();
    }
}
