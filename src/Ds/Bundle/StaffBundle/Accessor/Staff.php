<?php

namespace Ds\Bundle\StaffBundle\Accessor;

use Ds\Bundle\StaffBundle\Entity\Staff as StaffEntity;

/**
 * Trait Staff
 */
trait Staff
{
    /**
     * Set staff
     *
     * @param \Ds\Bundle\StaffBundle\Entity\Staff $staff
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
     * @return \Ds\Bundle\StaffBundle\Entity\Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }
}
