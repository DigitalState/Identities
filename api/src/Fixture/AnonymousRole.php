<?php

namespace App\Fixture;

use App\Entity\AnonymousRole as AnonymousRoleEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait AnonymousRole
 */
trait AnonymousRole
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $anonymous = $this->getReference($object->anonymous);

            if (!$anonymous) {
                throw new LogicException('Anonymous "'.$object->anonymous.'" does not exist.');
            }

            $anonymousRole = new AnonymousRoleEntity;
            $anonymousRole
                ->setAnonymous($anonymous)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setEntityUuids((array) $object->entity_uuids)
                ->setTenant($object->tenant);

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $anonymousRole->setRole($role);
            $manager->persist($anonymousRole);
        }

        $manager->flush();
    }
}
