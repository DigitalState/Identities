<?php

namespace App\Service;

use App\Entity\StaffPersona;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class StaffPersonaService
 */
final class StaffPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = StaffPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
