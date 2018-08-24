<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Individual as IndividualEntity;

/**
 * Trait Individual
 */
trait Individual
{
    /**
     * Set individual
     *
     * @param \AppBundle\Entity\Individual $individual
     * @return object
     */
    public function setIndividual(IndividualEntity $individual = null)
    {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Get individual
     *
     * @return \AppBundle\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }
}
