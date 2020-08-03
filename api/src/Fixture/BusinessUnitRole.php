<?php

namespace App\Fixture;

use App\Entity\BusinessUnitRole as BusinessUnitRoleEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait BusinessUnitRole
 */
trait BusinessUnitRole
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
            $businessUnit = $this->getReference($object->business_unit);

            if (!$businessUnit) {
                throw new LogicException('Business Unit "'.$object->business_unit.'" does not exist.');
            }

            $businessUnitRole = new BusinessUnitRoleEntity;
            $businessUnitRole
                ->setBusinessUnit($businessUnit)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setEntityUuids((array) $object->entity_uuids)
                ->setTenant($object->tenant);

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $businessUnitRole->setRole($role);
            $manager->persist($businessUnitRole);
        }

        $manager->flush();
    }
}
