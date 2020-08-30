<?php

namespace App\Fixture;

use App\Entity\SystemRole as SystemRoleEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait SystemRole
 */
trait SystemRole
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
            $system = $this->getReference($object->system);

            if (!$system) {
                throw new LogicException('System "'.$object->system.'" does not exist.');
            }

            $systemRole = new SystemRoleEntity;
            $systemRole
                ->setSystem($system)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setEntityUuids((array) $object->entity_uuids)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $systemRole->setCreatedAt($date);
            }

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $systemRole->setRole($role);
            $manager->persist($systemRole);
        }

        $manager->flush();
    }
}
