<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Role;
use AppBundle\EventListener\Entity\Role\AccessListener;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class RoleFixture
 */
abstract class RoleFixture extends ResourceFixture
{
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
            $role = new Role;
            $role
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setSlug($object->slug)
                ->setPermissions((array) $object->permissions)
                ->setTenant($object->tenant);
            $manager->persist($role);
            $manager->flush();
        }
    }
}
