<?php

namespace AppBundle\EventListener\Role;

use AppBundle\Entity\Role;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class PermissionsListener
 */
class PermissionsListener
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var \AppBundle\Service\RoleService
     */
    protected $roleService;

    /**
     * Constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Create access entries across each microservices
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function postPersist(Role $role)
    {
        // Circular reference error workaround
        // @todo Look into fixing this
        $this->roleService = $this->container->get('app.service.role');
        //

        $this->roleService->createAccess($role);
    }
}
