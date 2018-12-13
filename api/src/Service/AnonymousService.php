<?php

namespace App\Service;

use App\Entity\Anonymous;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AnonymousService
 */
final class AnonymousService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = Anonymous::class)
    {
        parent::__construct($manager, $entity);
    }
}
