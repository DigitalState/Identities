<?php

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityManager;
use Ds\Component\Api\Api\Api;
use Ds\Component\Api\Model\Access;
use Ds\Component\Api\Model\Permission;
use Ds\Component\Api\Query\AccessParameters;
use Ds\Component\Discovery\Service\DiscoveryService;
use Ds\Component\Entity\Service\EntityService;
use LogicException;

/**
 * Class RoleService
 */
class RoleService extends EntityService
{
    /**
     * @var \Ds\Component\Api\Api\Api
     */
    protected $api;

    /**
     * @var \Ds\Component\Discovery\Service\DiscoveryService
     */
    protected $discoveryService;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Api\Api\Api $api
     * @param \Ds\Component\Discovery\Service\DiscoveryService $discoveryService
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Api $api, DiscoveryService $discoveryService, $entity = Role::class)
    {
        parent::__construct($manager, $entity);
        $this->api = $api;
        $this->discoveryService = $discoveryService;
    }

    /**
     * Create access across all microservices
     *
     * @param \AppBundle\Entity\Role $role
     * @return \AppBundle\Service\RoleService
     * @throws \LogicException
     */
    public function createAccess(Role $role)
    {
        if (null === $role->getUuid()) {
            throw new LogicException('Role does not have a uuid.');
        }

        $services = $this->discoveryService->get();

        foreach ($role->getPermissions() as $service => $scopes) {
            if (
                property_exists($services, $service) &&
                $services->$service->enabled &&
                property_exists($services->$service, 'attributes') &&
                property_exists($services->$service->attributes, 'access') &&
                $services->$service->attributes->access
            ) {
                $access = new Access;
                $access
                    ->setOwner($role->getOwner())
                    ->setOwnerUuid($role->getOwnerUuid())
                    ->setAssignee('Role')
                    ->setAssigneeUuid($role->getUuid())
                    ->setVersion(1);

                foreach ($scopes as $scope) {
                    foreach ($scope['permissions'] as $entry) {
                        $permission = new Permission;
                        $permission
                            ->setScope($scope['scope'])
                            ->setEntity($scope['entity'])
                            ->setEntityUuid($scope['entityUuid'])
                            ->setKey($entry['key'])
                            ->setAttributes($entry['attributes']);
                        $access->addPermission($permission);
                    }
                }

                $this->api->get($service.'.access')->create($access);
            }
        }

        return $this;
    }

    /**
     * Delete access across all microservices
     *
     * @param \AppBundle\Entity\Role $role
     * @return \AppBundle\Service\RoleService
     * @throws \LogicException
     */
    public function deleteAccess(Role $role)
    {
        if (null === $role->getUuid()) {
            throw new LogicException('Role does not have a uuid.');
        }

        $services = $this->discoveryService->get();

        foreach ($services as $service => $config) {
            if (
                $config->enabled &&
                property_exists($config, 'attributes') &&
                property_exists($config->attributes, 'access') &&
                $config->attributes->access
            ) {
                $service = $this->api->get($service.'.access');
                $parameters = new AccessParameters;
                $parameters
                    ->setAssignee('Role')
                    ->setAssigneeUuid($role->getUuid());
                $accesses = $service->getList($parameters);

                foreach ($accesses as $access) {
                    $service->delete($access);
                }
            }
        }

        return $this;
    }
}
