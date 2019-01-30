<?php

namespace App\Service;

use App\Entity\Organization;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class OrganizationService
 */
final class OrganizationService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Organization::class)
    {
        parent::__construct($manager, $entity);
    }
}
