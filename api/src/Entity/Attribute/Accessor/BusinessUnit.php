<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\BusinessUnit as BusinessUnitEntity;

/**
 * Trait BusinessUnit
 */
trait BusinessUnit
{
    /**
     * Set businessUnit
     *
     * @param \App\Entity\BusinessUnit $businessUnit
     * @return object
     */
    public function setBusinessUnit(BusinessUnitEntity $businessUnit = null)
    {
        $this->businessUnit = $businessUnit;

        return $this;
    }

    /**
     * Get businessUnit
     *
     * @return \App\Entity\BusinessUnit
     */
    public function getBusinessUnit()
    {
        return $this->businessUnit;
    }
}
