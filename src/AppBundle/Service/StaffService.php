<?php

namespace AppBundle\Service;

use AppBundle\Entity\Staff;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class StaffService
 */
class StaffService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Staff::class)
    {
        parent::__construct($manager, $entity);
    }
}
