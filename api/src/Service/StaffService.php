<?php

namespace App\Service;

use App\Entity\Staff;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class StaffService
 */
final class StaffService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Staff::class)
    {
        parent::__construct($manager, $entity);
    }
}
