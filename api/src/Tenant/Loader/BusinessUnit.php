<?php

namespace App\Tenant\Loader;

use Ds\Component\Database\Util\Objects;
use Ds\Component\Tenant\Entity\Tenant;

/**
 * Trait BusinessUnit
 */
trait BusinessUnit
{
    /**
     * @var \App\Service\BusinessUnitService
     */
    private $businessUnitService;

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
        $manager = $this->businessUnitService->getManager();

        foreach ($objects as $object) {
            $businessUnit = $this->businessUnitService->createInstance();
            $businessUnit
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setTenant($object->tenant);
            $manager->persist($businessUnit);
            $manager->flush();
        }
    }
}
