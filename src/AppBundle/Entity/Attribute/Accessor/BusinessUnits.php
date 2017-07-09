<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\BusinessUnit;

/**
 * Trait BusinessUnits
 */
trait BusinessUnits
{
    /**
     * Add business unit
     *
     * @param \AppBundle\Entity\BusinessUnit $businessUnit
     * @return object
     */
    public function addBusinessUnit(BusinessUnit $businessUnit)
    {
        if (!$this->businessUnits->contains($businessUnit)) {
            $this->businessUnits->add($businessUnit);
        }

        return $this;
    }

    /**
     * Remove business unit
     *
     * @param \AppBundle\Entity\BusinessUnit $businessUnit
     * @return object
     */
    public function removeBusinessUnit(BusinessUnit $businessUnit)
    {
        if ($this->businessUnits->contains($businessUnit)) {
            $this->businessUnits->removeElement($businessUnit);
        }

        return $this;
    }

    /**
     * Get business units
     *
     * @return array
     */
    public function getBusinessUnits()
    {
        return $this->businessUnits->toArray();
    }
}
