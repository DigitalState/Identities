<?php

namespace AppBundle\Entity\Attribute\Accessor;

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
    public function setIdentity($identity)
    {
        throw new LogicException('Method call not allowed.');
    }

    /**
     * Get identity
     *
     * @return string
     */
    public function getIdentity()
    {
        $identity = basename(str_replace('\\', '/', get_class($this)));

        return $identity;
    }
}
