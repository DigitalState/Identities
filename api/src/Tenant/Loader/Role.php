<?php

namespace App\Tenant\Loader;

use App\EventListener\Entity\Role\PropagationListener;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Tenant\Entity\Tenant;

/**
 * Trait Role
 */
trait Role
{
    /**
     * @var \App\Service\RoleService
     */
    private $roleService;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(Tenant $tenant)
    {
        $eventManager = $this->roleService->getManager()->getEventManager();

        foreach ($eventManager->getListeners() as $event => $listeners) {
            foreach ($listeners as $key => $listener) {
                if (is_object($listener) && $listener instanceof PropagationListener) {
                    $listener->setEnabled(false);
                } else if (is_string($listener) && $listener === PropagationListener::class) {
                    $eventManager->removeEventListener(['postPersist'], $listener);
                }
            }
        }

        $data = (array) json_decode(json_encode($tenant->getData()));
        $objects = Objects::parseFile($this->path, $data);
        $manager = $this->roleService->getManager();

        foreach ($objects as $object) {
            $role = $this->roleService->createInstance();
            $role
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setSlug($object->slug)
                ->setTitle((array) $object->title)
                ->setPermissions((array) $object->permissions)
                ->setTenant($object->tenant);
            $manager->persist($role);
            $manager->flush();
        }
    }
}
