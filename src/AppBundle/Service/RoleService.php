<?php

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityManager;
use Ds\Component\Api\Api\Api;
use Ds\Component\Api\Model\Access;
use Ds\Component\Api\Model\Permission;
use Ds\Component\Api\Query\AccessParameters;
use Ds\Component\Discovery\Model\Config;
use Ds\Component\Discovery\Repository\ConfigRepository;
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
     * @var \Ds\Component\Discovery\Repository\ConfigRepository
     */
    protected $configRepository;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Api\Api\Api $api
     * @param \Ds\Component\Discovery\Repository\ConfigRepository $configRepository
     * @param string $entity
     */
    public function __construct(EntityManager $manager, Api $api, ConfigRepository $configRepository, $entity = Role::class)
    {
        parent::__construct($manager, $entity);
        $this->api = $api;
        $this->configRepository = $configRepository;
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

        $configs = $this->configRepository->findBy([
            'directory' => 'services',
            'recurse' => true
        ]);

        foreach ($role->getPermissions() as $service => $scopes) {
            $config = $configs->filter(function(Config $config) use ($service) {
                return $config->getKey() === 'services/'.$service.'/enabled';
            })->first();

            if (!$config) {
                continue;
            }

            if ($config->getValue() !== 'True') {
                continue;
            }

            $config = $configs->filter(function(Config $config) use ($service) {
                return $config->getKey() === 'services/'.$service.'/attributes/access';
            })->first();

            if (!$config) {
                continue;
            }

            if ($config->getValue() !== 'True') {
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

        $configs = $this->configRepository->findBy([
            'directory' => 'services',
            'recurse' => true
        ]);

        foreach ($role->getPermissions() as $service => $scopes) {
            $config = $configs->filter(function(Config $config) use ($service) {
                return $config->getKey() === 'services/'.$service.'/enabled';
            })->first();

            if (!$config) {
                continue;
            }

            if ($config->getValue() !== 'True') {
                continue;
            }

            $config = $configs->filter(function(Config $config) use ($service) {
                return $config->getKey() === 'services/'.$service.'/attributes/access';
            })->first();

            if (!$config) {
                continue;
            }

            if ($config->getValue() !== 'True') {
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
