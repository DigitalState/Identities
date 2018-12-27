<?php

namespace App\Fixture;

use App\Entity\Role as RoleEntity;
use App\EventListener\Entity\Role\AccessListener;
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
        $events = $manager->getEventManager()->getListeners();

        foreach ($events as $event => $listeners) {
            foreach ($listeners as $listener) {
                if (!is_object($listener)) {
                    continue;
                }

                if ($listener instanceof AccessListener) {
                    $listener->setEnabled(false);
                }
            }
        }

        $objects = $this->parse($this->path);

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
            $this->setReference($object->uuid, $role);
        }

        $manager->flush();
    }
}
