<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Persona as PersonaEntity;

/**
 * Trait Persona
 */
trait Persona
{
    /**
     * Set persona
     *
     * @param \App\Entity\Persona $persona
     * @return object
     */
    public function setPersona(PersonaEntity $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \App\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
}
