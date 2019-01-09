<?php

namespace App\Fixture;

use App\Entity\Staff as StaffEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait Staff
 */
trait Staff
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
            $staff = new StaffEntity;
            $staff
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $this->getReference($uuid);

                if (!$role) {
                    throw new LogicException('Role "'.$uuid.'" does not exist.');
                }

                $staff->addRole($role);
            }

            foreach ($object->business_units as $uuid) {
                $businessUnit = $this->getReference($uuid);

                if (!$businessUnit) {
                    throw new LogicException('Business Unit "'.$uuid.'" does not exist.');
                }

                $staff->addBusinessUnit($businessUnit);
            }

            $manager->persist($staff);
            $this->setReference($object->uuid, $staff);
        }

        $manager->flush();
    }
}
