<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Staff;

/**
 * Trait Staffs
 */
trait Staffs
{
    /**
     * Add business unit
     *
     * @param \AppBundle\Entity\Staff $staff
     * @return object
     */
    public function addStaff(Staff $staff)
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs->add($staff);
        }

        return $this;
    }

    /**
     * Remove business unit
     *
     * @param \AppBundle\Entity\Staff $staff
     * @return object
     */
    public function removeStaff(Staff $staff)
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
        }

        return $this;
    }

    /**
     * Get business units
     *
     * @return array
     */
    public function getStaffs()
    {
        return $this->staffs->toArray();
    }
}
