<?php

namespace App\Service;

use App\Entity\OrganizationRole;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class OrganizationRoleService
 */
final class OrganizationRoleService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = OrganizationRole::class)
    {
        parent::__construct($manager, $entity);
    }
}
