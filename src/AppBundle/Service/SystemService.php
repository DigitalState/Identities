<?php

namespace AppBundle\Service;

use AppBundle\Entity\System;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class SystemService
 */
class SystemService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = System::class)
    {
        parent::__construct($manager, $entity);
    }
}
