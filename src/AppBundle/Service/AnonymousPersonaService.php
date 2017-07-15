<?php

namespace AppBundle\Service;

use AppBundle\Entity\AnonymousPersona;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AnonymousPersonaService
 */
class AnonymousPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = AnonymousPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
