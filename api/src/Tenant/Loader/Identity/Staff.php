<?php

namespace App\Tenant\Loader\Identity;

use App\Entity\Role;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Tenant\Entity\Tenant;
use LogicException;

/**
 * Trait Staff
 */
trait Staff
{
    /**
     * @var \App\Service\StaffService
     */
    private $staffService;

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
        $manager = $this->staffService->getManager();

        foreach ($objects as $object) {
            $staff = $this->staffService->createInstance();
            $staff
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);


            foreach ($object->roles as $uuid) {
                $role = $manager->getRepository(Role::class)->findOneBy(['uuid' => $uuid]);

                if (!$role) {
                    throw new LogicException('Role "'.$uuid.'" does not exist.');
                }

                $staff->addRole($role);
            }

            $manager->persist($staff);
            $manager->flush();
        }
    }
}
