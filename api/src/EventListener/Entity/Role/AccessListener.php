<?php

namespace App\EventListener\Entity\Role;

use App\Entity\Role;
use App\Service\RoleService;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Ds\Component\Container\Attribute\Container;
use Ds\Component\Model\Attribute\Enabled;
use Ds\Component\Model\Type\Enableable;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AccessListener
 */
final class AccessListener implements Enableable
{
    use Container;
    use Enabled;

    /**
     * Constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->enabled = true;
    }

    /**
     * Create access across all microservices when a role is created
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $event
     */
    public function postPersist(LifecycleEventArgs $event)
    {
        if (!$this->isEnabled()) {
            return;
        }

        $entity = $event->getEntity();

        if (!$entity instanceof Role) {
            return;
        }

        $service = $this->container->get(RoleService::class);
        $service->createAccess($entity);
    }

    /**
     * Update access across all microservices when a role is updated
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $event
     */
    public function postUpdate(LifecycleEventArgs $event)
    {
        if (!$this->isEnabled()) {
            return;
        }

        $entity = $event->getEntity();

        if (!$entity instanceof Role) {
            return;
        }

        $service = $this->container->get(RoleService::class);
        $service->deleteAccess($entity);
        $service->createAccess($entity);
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
        if (!$this->isEnabled()) {
            return;
        }

        foreach ($event->getEntityManager()->getUnitOfWork()->getScheduledEntityDeletions() as $entity) {
            if (!$entity instanceof Role) {
                continue;
            }

            $service = $this->container->get(RoleService::class);
            $service->deleteAccess($entity);
        }
    }
}
