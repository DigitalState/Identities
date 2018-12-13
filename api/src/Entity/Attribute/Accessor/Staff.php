<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Staff as StaffEntity;

/**
 * Trait Staff
 */
trait Staff
{
    /**
     * Set staff
     *
     * @param \App\Entity\Staff $staff
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
     * @return \App\Entity\Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }
}
