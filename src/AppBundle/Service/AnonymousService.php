<?php

namespace AppBundle\Service;

use AppBundle\Entity\Anonymous;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AnonymousService
 */
class AnonymousService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Anonymous::class)
    {
        parent::__construct($manager, $entity);
    }
}
