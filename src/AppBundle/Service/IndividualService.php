<?php

namespace AppBundle\Service;

use AppBundle\Entity\Individual;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class IndividualService
 */
class IndividualService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Individual::class)
    {
        parent::__construct($manager, $entity);
    }
}
