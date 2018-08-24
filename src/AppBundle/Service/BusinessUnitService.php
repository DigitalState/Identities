<?php

namespace AppBundle\Service;

use AppBundle\Entity\BusinessUnit;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class BusinessUnitService
 */
class BusinessUnitService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = BusinessUnit::class)
    {
        parent::__construct($manager, $entity);
    }
}
