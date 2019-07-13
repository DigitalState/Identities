<?php

namespace App\Fixture;

use App\Entity\StaffRole as StaffRoleEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait StaffRole
 */
trait StaffRole
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
            $staff = $this->getReference($object->staff);

            if (!$staff) {
                throw new LogicException('Staff "'.$object->staff.'" does not exist.');
            }

            $staffRole = new StaffRoleEntity;
            $staffRole
                ->setStaff($staff)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $staffRole->setRole($role);

            foreach ($object->business_units as $uuid) {
                $businessUnit = $this->getReference($uuid);

                if (!$businessUnit) {
                    throw new LogicException('Business Unit "'.$uuid.'" does not exist.');
                }

                $staffRole->addBusinessUnit($businessUnit);
            }

            $manager->persist($staffRole);
        }

        $manager->flush();
    }
}
