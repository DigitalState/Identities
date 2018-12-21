<?php

namespace App\Fixture;

use App\Entity\Role as RoleEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Role
 */
trait Role
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $metadata = $manager->getClassMetadata(Role::class);

        foreach ($metadata->entityListeners as $event => $listeners) {
            foreach ($listeners as $key => $listener) {
                if (AccessListener::class === $listener['class']) {
                    unset($metadata->entityListeners[$event][$key]);
                }
            }
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $role = new RoleEntity;
            $role
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setSlug($object->slug)
                ->setPermissions((array) $object->permissions)
                ->setTenant($object->tenant);
            $manager->persist($role);
        }

        $manager->flush();
    }
}
