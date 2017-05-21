<?php

namespace Ds\Bundle\PersonaBundle\Accessor;

use Ds\Bundle\PersonaBundle\Entity\Persona as PersonaEntity;

/**
 * Trait Persona
 */
trait Persona
{
    /**
     * Set persona
     *
     * @param \Ds\Bundle\PersonaBundle\Entity\Persona $persona
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
     * @return \Ds\Bundle\PersonaBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }
}
