<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Individual as IndividualEntity;

/**
 * Trait Individual
 */
trait Individual
{
    /**
     * Set individual
     *
     * @param \App\Entity\Individual $individual
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
     * @return \App\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }
}
