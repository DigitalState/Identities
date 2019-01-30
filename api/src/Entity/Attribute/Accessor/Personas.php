<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Persona;

/**
 * Trait Personas
 */
trait Personas
{
    /**
     * Add persona
     *
     * @param \App\Entity\Persona $persona
     * @return object
     */
    public function addPersona(Persona $persona)
    {
        if (!$this->personas->contains($persona)) {
            $this->personas->add($persona);
        }

        return $this;
    }

    /**
     * Remove persona
     *
     * @param \App\Entity\Persona $persona
     * @return object
     */
    public function removePersona(Persona $persona)
    {
        if ($this->personas->contains($persona)) {
            $this->personas->removeElement($persona);
        }

        return $this;
    }

    /**
     * Get personas
     *
     * @return array
     */
    public function getPersonas()
    {
        return $this->personas->toArray();
    }
}
