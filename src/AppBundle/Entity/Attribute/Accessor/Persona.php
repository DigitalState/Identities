<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Persona as PersonaEntity;

/**
 * Trait Persona
 */
trait Persona
{
    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
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
     * @return \AppBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
}
