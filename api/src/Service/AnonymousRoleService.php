<?php

namespace App\Service;

use App\Entity\AnonymousRole;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AnonymousRoleService
 */
final class AnonymousRoleService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = AnonymousRole::class)
    {
        parent::__construct($manager, $entity);
    }
}
