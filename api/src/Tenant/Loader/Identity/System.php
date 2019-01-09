<?php

namespace App\Tenant\Loader\Identity;

use Ds\Component\Database\Util\Objects;
use Ds\Component\Tenant\Entity\Tenant;

/**
 * Trait System
 */
trait System
{
    /**
     * @var \App\Service\SystemService
     */
    private $systemService;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(Tenant $tenant)
    {
        $data = (array) json_decode(json_encode($tenant->getData()));
        $objects = Objects::parseFile($this->path, $data);
        $manager = $this->systemService->getManager();

        foreach ($objects as $object) {
            $system = $this->systemService->createInstance();
            $system
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);
            $manager->persist($system);
            $manager->flush();
        }
    }
}
