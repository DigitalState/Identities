<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\System as SystemEntity;

/**
 * Trait System
 */
trait System
{
    /**
     * Set system
     *
     * @param \AppBundle\Entity\System $system
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
     * @return \AppBundle\Entity\System
     */
    public function getSystem()
    {
        return $this->system;
    }
}
