<?php

namespace Ds\Bundle\AdminBundle\Attribute\Accessor;

use Ds\Bundle\AdminBundle\Entity\Admin as AdminEntity;

/**
 * Trait Admin
 */
trait Admin
{
    /**
     * Set admin
     *
     * @param \Ds\Bundle\AdminBundle\Entity\Admin $admin
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
     * @return \Ds\Bundle\AdminBundle\Entity\Admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
