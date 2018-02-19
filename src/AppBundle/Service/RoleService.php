<?php

namespace AppBundle\Service;

use AppBundle\Entity\Role;
use Doctrine\ORM\EntityManager;
use Ds\Component\Api\Api\Api;
use Ds\Component\Api\Model\Access;
use Ds\Component\Api\Model\Permission;
use Ds\Component\Entity\Service\EntityService;
use Ds\Component\Security\Service\AccessService;
use Ds\Component\Security\Service\PermissionService;
use LogicException;

/**
 * Class RoleService
 */
class RoleService extends EntityService
{
    /**
     * @var \Ds\Component\Security\Service\AccessService
     */
    protected $accessService;

    /**
     * @var \Ds\Component\Security\Service\PermissionService
     */
    protected $permissionService;

    /**
     * @var \Ds\Component\Api\Api\Api
     */
    protected $api;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param \Ds\Component\Security\Service\AccessService $accessService
     * @param \Ds\Component\Api\Api\Api $api
     * @param string $entity
     */
    public function __construct(EntityManager $manager, AccessService $accessService, PermissionService $permissionService, Api $api, $entity = Role::class)
    {
        parent::__construct($manager, $entity);

        $this->accessService = $accessService;
        $this->permissionService = $permissionService;
        $this->api = $api;
    }

    /**
     * @param \AppBundle\Entity\Role $role
     */
    public function createAccess(Role $role)
    {
        if (null === $role->getUuid()) {
            throw new LogicException('Role does not have a uuid.');
        }

        foreach ($role->getPermissions() as $service => $scopes) {
//            if ('identities' === $service) {
//                $access = $this->accessService->createInstance();
//                $access
//                    ->setOwner($role->getOwner())
//                    ->setOwnerUuid($role->getOwnerUuid())
//                    ->setAssignee('Role')
//                    ->setAssigneeUuid($role->getUuid());
//                $manager = $this->accessService->getManager();
//                $manager->persist($access);
//                $manager->flush();
//
//                foreach ($scopes as $scope) {
//                    foreach ($scope['permissions'] as $entry) {
//                        $permission = $this->permissionService->createInstance();
//                        $permission
//                            ->setAccess($access)
//                            ->setScope($scope['scope'])
//                            ->setEntity($scope['entity'])
//                            ->setEntityUuid($scope['entityUuid'])
//                            ->setKey($entry['key'])
//                            ->setAttributes($entry['attributes']);
//                        $manager = $this->permissionService->getManager();
//                        $manager->persist($permission);
//                        $manager->flush();
//                    }
//                }
//            } else {
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
//        }
    }
}
