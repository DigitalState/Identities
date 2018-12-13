<?php

namespace App\Service;

use App\Entity\Individual;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class IndividualService
 */
final class IndividualService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Individual::class)
    {
        parent::__construct($manager, $entity);
    }
}
