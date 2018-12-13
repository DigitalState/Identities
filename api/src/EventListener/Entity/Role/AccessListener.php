<?php

namespace App\EventListener\Entity\Role;

use App\Entity\Role;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Ds\Component\Container\EventListener\ContainerListener;

/**
 * Class AccessListener
 */
final class AccessListener extends ContainerListener
{
    /**
     * Create access across all microservices when a role is created
     *
     * @param \App\Entity\Role $role
     */
    public function postPersist(Role $role)
    {
        $service = $this->container->get('app.service.role');
        $service->createAccess($role);
    }

    /**
     * Update access across all microservices when a role is updated
     *
     * @param \App\Entity\Role $role
     */
    public function postUpdate(Role $role)
    {
        $service = $this->container->get('app.service.role');
        $service->deleteAccess($role);
        $service->createAccess($role);
    }

    /**
     * Remove access across all microservices when a role is removed
     *
     * The preFlush event is used instead of postRemove as a workaround soft-deletable
     *
     * @param \Doctrine\ORM\Event\PreFlushEventArgs $event
     */
    public function preFlush(PreFlushEventArgs $event)
    {
        foreach ($event->getEntityManager()->getUnitOfWork()->getScheduledEntityDeletions() as $entity) {
            if (!$entity instanceof Role) {
                continue;
            }

            $service = $this->container->get('app.service.role');
            $service->deleteAccess($entity);
        }
    }
}
