<?php

namespace App\Service;

use App\Entity\Persona;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class PersonaService
 */
final class PersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Persona::class)
    {
        parent::__construct($manager, $entity);
    }
}
