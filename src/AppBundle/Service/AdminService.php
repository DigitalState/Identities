<?php

namespace AppBundle\Service;

use AppBundle\Entity\Admin;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AdminService
 */
class AdminService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Admin::class)
    {
        parent::__construct($manager, $entity);
    }
}
