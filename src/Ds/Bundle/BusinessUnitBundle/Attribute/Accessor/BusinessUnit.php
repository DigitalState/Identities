<?php

namespace Ds\Bundle\BusinessUnitBundle\Attribute\Accessor;

use Ds\Bundle\BusinessUnitBundle\Entity\BusinessUnit as BusinessUnitEntity;

/**
 * Trait BusinessUnit
 */
trait BusinessUnit
{
    /**
     * Set businessUnit
     *
     * @param \Ds\Bundle\BusinessUnitBundle\Entity\BusinessUnit $businessUnit
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
     * @return \Ds\Bundle\BusinessUnitBundle\Entity\BusinessUnit
     */
    public function getBusinessUnit()
    {
        return $this->businessUnit;
    }
}
