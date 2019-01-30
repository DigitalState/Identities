<?php

namespace App\Entity\Attribute\Accessor\Identity;

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
     */
    public function setIdentity(?string $identity)
    {
    }

    /**
     * Get identity
     *
     * @return string
     */
    public function getIdentity(): ?string
    {
        $identity = basename(str_replace('\\', '/', get_class($this)));

        return $identity;
    }
}
