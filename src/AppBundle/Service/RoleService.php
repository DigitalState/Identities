<?php

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityManager;
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
class RoleService extends EntityService
{
    /**
     * @var \Ds\Component\Api\Api\Api
     */
    protected $api;

    /**
     * @var \Ds\Component\Discovery\Repository\ServiceRepository
     */
    protected $serviceRepository;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Api\Api\Api $api
     * @param \Ds\Component\Discovery\Repository\ServiceRepository $serviceRepository
     * @param string $namespace
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Api $api, ServiceRepository $serviceRepository, $namespace = 'ds', $entity = Role::class)
    {
        parent::__construct($manager, $entity);
        $this->api = $api;
        $this->serviceRepository = $serviceRepository;
        $this->namespace = $namespace;
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

        foreach ($role->getPermissions() as $service => $scopes) {
            if (!$this->serviceRepository->find($this->namespace.$service.'_api_80')) {
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
     * @param \AppBundle\Entity\Role $role
     * @return \AppBundle\Service\RoleService
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
