<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Organization as OrganizationEntity;

/**
 * Trait Organization
 */
trait Organization
{
    /**
     * Set organization
     *
     * @param \App\Entity\Organization $organization
     * @return object
     */
    public function setOrganization(OrganizationEntity $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \App\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}
