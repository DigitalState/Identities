<?php

namespace App\Service;

use App\Entity\BusinessUnit;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class BusinessUnitService
 */
final class BusinessUnitService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = BusinessUnit::class)
    {
        parent::__construct($manager, $entity);
    }
}
