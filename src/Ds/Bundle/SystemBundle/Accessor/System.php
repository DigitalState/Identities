<?php

namespace Ds\Bundle\SystemBundle\Accessor;

use Ds\Bundle\SystemBundle\Entity\System as SystemEntity;

/**
 * Trait System
 */
trait System
{
    /**
     * Set system
     *
     * @param \Ds\Bundle\SystemBundle\Entity\System $system
     * @return object
     */
    public function setSystem(SystemEntity $system = null)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * Get system
     *
     * @return \Ds\Bundle\SystemBundle\Entity\System
     */
    public function getSystem()
    {
        return $this->system;
    }
}
