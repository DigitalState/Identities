<?php

namespace App\Service;

use App\Entity\OrganizationPersona;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class OrganizationPersonaService
 */
final class OrganizationPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = OrganizationPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
