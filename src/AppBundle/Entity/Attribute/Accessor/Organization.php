<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Organization as OrganizationEntity;

/**
 * Trait Organization
 */
trait Organization
{
    /**
     * Set organization
     *
     * @param \AppBundle\Entity\Organization $organization
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
     * @return \AppBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}
