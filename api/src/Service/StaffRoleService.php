<?php

namespace App\Service;

use App\Entity\StaffRole;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class StaffRoleService
 */
final class StaffRoleService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = StaffRole::class)
    {
        parent::__construct($manager, $entity);
    }
}
