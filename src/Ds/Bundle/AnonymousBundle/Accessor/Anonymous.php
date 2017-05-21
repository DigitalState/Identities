<?php

namespace Ds\Bundle\AnonymousBundle\Accessor;

use Ds\Bundle\AnonymousBundle\Entity\Anonymous as AnonymousEntity;

/**
 * Trait Anonymous
 */
trait Anonymous
{
    /**
     * Set anonymous
     *
     * @param \Ds\Bundle\AnonymousBundle\Entity\Anonymous $anonymous
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
     * @return \Ds\Bundle\AnonymousBundle\Entity\Anonymous
     */
    public function getAnonymous()
    {
        return $this->anonymous;
    }
}
