<?php

namespace App\Service;

use App\Entity\SystemRole;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class SystemRoleService
 */
final class SystemRoleService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = SystemRole::class)
    {
        parent::__construct($manager, $entity);
    }
}
