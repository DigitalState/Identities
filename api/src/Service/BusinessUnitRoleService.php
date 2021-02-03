<?php

namespace App\Service;

use App\Entity\BusinessUnitRole;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class BusinessUnitRoleService
 */
final class BusinessUnitRoleService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = BusinessUnitRole::class)
    {
        parent::__construct($manager, $entity);
    }
}
