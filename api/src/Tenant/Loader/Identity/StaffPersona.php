<?php

namespace App\Tenant\Loader\Identity;

use App\Entity\Staff as StaffEntity;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Tenant\Entity\Tenant;

/**
 * Trait StaffPersona
 */
trait StaffPersona
{
    /**
     * @var \App\Service\StaffPersonaService
     */
    private $staffPersonaService;

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
        $manager = $this->staffPersonaService->getManager();

        foreach ($objects as $object) {
            $staff = $manager->getRepository(StaffEntity::class)->findOneBy(['uuid' => $object->staff]);
            $persona = $this->staffPersonaService->createInstance();
            $persona
                ->setStaff($staff)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($persona);
            $manager->flush();
        }
    }
}
