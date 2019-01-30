<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Individual;

/**
 * Trait Individuals
 */
trait Individuals
{
    /**
     * Add business unit
     *
     * @param \App\Entity\Individual $individual
     * @return object
     */
    public function addIndividual(Individual $individual)
    {
        if (!$this->individuals->contains($individual)) {
            $this->individuals->add($individual);
        }

        return $this;
    }

    /**
     * Remove business unit
     *
     * @param \App\Entity\Individual $individual
     * @return object
     */
    public function removeIndividual(Individual $individual)
    {
        if ($this->individuals->contains($individual)) {
            $this->individuals->removeElement($individual);
        }

        return $this;
    }

    /**
     * Get business units
     *
     * @return array
     */
    public function getIndividuals()
    {
        return $this->individuals->toArray();
    }
}
