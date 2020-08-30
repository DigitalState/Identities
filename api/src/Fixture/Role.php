<?php

namespace App\Fixture;

use App\Entity\Role as RoleEntity;
use App\EventListener\Entity\Role\PropagationListener;
use DateTime;
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
        $eventManager = $manager->getEventManager();

        foreach ($eventManager->getListeners() as $event => $listeners) {
            foreach ($listeners as $key => $listener) {
                if (is_object($listener) && $listener instanceof PropagationListener) {
                    $listener->setEnabled(false);
                } else if (is_string($listener) && $listener === PropagationListener::class) {
                    $eventManager->removeEventListener(['postPersist'], $listener);
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
                ->setData((array) $object->data)
                ->setPermissions((array) $object->permissions)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $role->setCreatedAt($date);
            }

            $manager->persist($role);
            $this->setReference($object->uuid, $role);
        }

        $manager->flush();
    }
}
