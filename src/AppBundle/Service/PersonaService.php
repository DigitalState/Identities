<?php

namespace AppBundle\Service;

use AppBundle\Entity\Persona;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class PersonaService
 */
class PersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = Persona::class)
    {
        parent::__construct($manager, $entity);
    }
}
