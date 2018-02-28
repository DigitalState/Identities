<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Role;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class RoleFixture
 */
abstract class RoleFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $roles = $this->parse($this->getResource());

        foreach ($roles as $role) {
            $entity = new Role;
            $entity
                ->setUuid($role['uuid'])
                ->setOwner($role['owner'])
                ->setOwnerUuid($role['owner_uuid'])
                ->setTitle($role['title'])
                ->setPermissions($role['permissions']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
