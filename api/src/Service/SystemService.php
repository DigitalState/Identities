<?php

namespace App\Service;

use App\Entity\System;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class SystemService
 */
final class SystemService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = System::class)
    {
        parent::__construct($manager, $entity);
    }
}
