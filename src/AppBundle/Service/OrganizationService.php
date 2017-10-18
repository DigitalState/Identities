<?php

namespace AppBundle\Service;

use AppBundle\Entity\Organization;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class OrganizationService
 */
class OrganizationService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Organization::class)
    {
        parent::__construct($manager, $entity);
    }
}
