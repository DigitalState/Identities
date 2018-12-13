<?php

namespace App\Service;

use App\Entity\AnonymousPersona;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class AnonymousPersonaService
 */
final class AnonymousPersonaService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = AnonymousPersona::class)
    {
        parent::__construct($manager, $entity);
    }
}
