<?php

namespace AppBundle\Entity\Attribute\Accessor;

use AppBundle\Entity\Anonymous as AnonymousEntity;

/**
 * Trait Anonymous
 */
trait Anonymous
{
    /**
     * Set anonymous
     *
     * @param \AppBundle\Entity\Anonymous $anonymous
     * @return object
     */
    public function setAnonymous(AnonymousEntity $anonymous = null)
    {
        $this->anonymous = $anonymous;

        return $this;
    }

    /**
     * Get anonymous
     *
     * @return \AppBundle\Entity\Anonymous
     */
    public function getAnonymous()
    {
        return $this->anonymous;
    }
}
