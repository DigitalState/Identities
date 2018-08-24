<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Staff as StaffEntity;

/**
 * Trait Staff
 */
trait Staff
{
    /**
     * Set staff
     *
     * @param \AppBundle\Entity\Staff $staff
     * @return object
     */
    public function setStaff(StaffEntity $staff = null)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
     * Get staff
     *
     * @return \AppBundle\Entity\Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }
}
