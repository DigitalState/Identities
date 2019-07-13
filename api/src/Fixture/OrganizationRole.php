<?php

namespace App\Fixture;

use App\Entity\OrganizationRole as OrganizationRoleEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait OrganizationRole
 */
trait OrganizationRole
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
            $organization = $this->getReference($object->organization);

            if (!$organization) {
                throw new LogicException('Organization "'.$object->organization.'" does not exist.');
            }

            $organizationRole = new OrganizationRoleEntity;
            $organizationRole
                ->setOrganization($organization)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $organizationRole->setRole($role);

            foreach ($object->business_units as $uuid) {
                $businessUnit = $this->getReference($uuid);

                if (!$businessUnit) {
                    throw new LogicException('Business Unit "'.$uuid.'" does not exist.');
                }

                $organizationRole->addBusinessUnit($businessUnit);
            }

            $manager->persist($organizationRole);
        }

        $manager->flush();
    }
}
