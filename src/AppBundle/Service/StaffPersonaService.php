<?php

namespace AppBundle\Service;

use AppBundle\Entity\StaffPersona;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class StaffPersonaService
 */
class StaffPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = StaffPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
