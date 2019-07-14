<?php

namespace App\Service;

use App\Entity\IndividualRole;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class IndividualRoleService
 */
final class IndividualRoleService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = IndividualRole::class)
    {
        parent::__construct($manager, $entity);
    }
}
