<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\BusinessUnit as BusinessUnitEntity;

/**
 * Trait BusinessUnit
 */
trait BusinessUnit
{
    /**
     * Set businessUnit
     *
     * @param \AppBundle\Entity\BusinessUnit $businessUnit
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
     * @return \AppBundle\Entity\BusinessUnit
     */
    public function getBusinessUnit()
    {
        return $this->businessUnit;
    }
}
