<?php

namespace App\Service;

use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Api\Api\Api;
use Ds\Component\Api\Model\Access;
use Ds\Component\Api\Model\Permission;
use Ds\Component\Api\Query\AccessParameters;
use Ds\Component\Discovery\Repository\ServiceRepository;
use Ds\Component\Entity\Service\EntityService;
use LogicException;

/**
 * Class RoleService
 */
final class RoleService extends EntityService
{
    /**
     * @var \Ds\Component\Api\Api\Api
     */
    private $api;

    /**
     * @var \Ds\Component\Discovery\Repository\ServiceRepository
     */
    private $serviceRepository;

    /**
     * @var string
     */
    private $namespace;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param \Ds\Component\Api\Api\Api $api
     * @param \Ds\Component\Discovery\Repository\ServiceRepository $serviceRepository
     * @param string $namespace
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, Api $api, ServiceRepository $serviceRepository, string $namespace = 'ds', string $entity = Role::class)
    {
        parent::__construct($manager, $entity);
        $this->api = $api;
        $this->serviceRepository = $serviceRepository;
        $this->namespace = $namespace;
    }

    /**
     * Create access across all microservices
     *
     * @param \App\Entity\Role $role
     * @return \App\Service\RoleService
     * @throws \LogicException
     */
    public function createAccess(Role $role)
    {
        if (null === $role->getUuid()) {
            throw new LogicException('Role does not have a uuid.');
        }

        foreach ($role->getPermissions() as $service => $scopes) {
            if (!$this->serviceRepository->find($this->namespace.'_'.$service.'_api_http')) {
                continue;
            }

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

        return $this;
    }

    /**
     * Delete access across all microservices
     *
     * @param \App\Entity\Role $role
     * @return \App\Service\RoleService
     * @throws \LogicException
     */
    public function deleteAccess(Role $role)
    {
        if (null === $role->getUuid()) {
            throw new LogicException('Role does not have a uuid.');
        }

        foreach ($role->getPermissions() as $service => $scopes) {
            if (!$this->serviceRepository->find($this->namespace.$service.'_api_80')) {
                continue;
            }

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

        return $this;
    }
}
