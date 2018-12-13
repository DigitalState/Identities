<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Anonymous as AnonymousEntity;

/**
 * Trait Anonymous
 */
trait Anonymous
{
    /**
     * Set anonymous
     *
     * @param \App\Entity\Anonymous $anonymous
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
     * @return \App\Entity\Anonymous
     */
    public function getAnonymous()
    {
        return $this->anonymous;
    }
}
