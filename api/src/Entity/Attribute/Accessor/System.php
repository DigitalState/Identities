<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\System as SystemEntity;

/**
 * Trait System
 */
trait System
{
    /**
     * Set system
     *
     * @param \App\Entity\System $system
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
     * @return \App\Entity\System
     */
    public function getSystem()
    {
        return $this->system;
    }
}
