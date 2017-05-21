<?php

namespace Ds\Bundle\IndividualBundle\Accessor;

use Ds\Bundle\IndividualBundle\Entity\Individual as IndividualEntity;

/**
 * Trait Individual
 */
trait Individual
{
    /**
     * Set individual
     *
     * @param \Ds\Bundle\IndividualBundle\Entity\Individual $individual
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
     * @return \Ds\Bundle\IndividualBundle\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }
}
