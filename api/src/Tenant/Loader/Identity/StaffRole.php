<?php

namespace App\Tenant\Loader\Identity;

use App\Entity\Staff as StaffEntity;
use App\Entity\Role as RoleEntity;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Tenant\Entity\Tenant;

/**
 * Trait StaffRole
 */
trait StaffRole
{
    /**
     * @var \App\Service\StaffRoleService
     */
    private $staffRoleService;

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
        $manager = $this->staffRoleService->getManager();

        foreach ($objects as $object) {
            $staff = $manager->getRepository(StaffEntity::class)->findOneBy(['uuid' => $object->staff]);
            $role = $manager->getRepository(RoleEntity::class)->findOneBy(['uuid' => $object->role]);
            $staffRole = $this->staffRoleService->createInstance();
            $staffRole
                ->setStaff($staff)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setRole($role)
                ->setTenant($object->tenant);
            $manager->persist($staffRole);
            $manager->flush();
        }
    }
}
