<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Admin as AdminEntity;

/**
 * Trait Admin
 */
trait Admin
{
    /**
     * Set admin
     *
     * @param \AppBundle\Entity\Admin $admin
     * @return object
     */
    public function setAdmin(AdminEntity $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \AppBundle\Entity\Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
