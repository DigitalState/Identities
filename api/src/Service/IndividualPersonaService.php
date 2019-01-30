<?php

namespace App\Service;

use App\Entity\IndividualPersona;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class IndividualPersonaService
 */
final class IndividualPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = IndividualPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
