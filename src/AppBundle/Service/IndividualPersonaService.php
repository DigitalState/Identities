<?php

namespace AppBundle\Service;

use AppBundle\Entity\IndividualPersona;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class IndividualPersonaService
 */
class IndividualPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = IndividualPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
