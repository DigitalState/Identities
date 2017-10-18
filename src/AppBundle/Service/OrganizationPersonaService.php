<?php

namespace AppBundle\Service;

use AppBundle\Entity\OrganizationPersona;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class OrganizationPersonaService
 */
class OrganizationPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = OrganizationPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
