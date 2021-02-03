<?php

namespace App\Fixture;

use App\Entity\OrganizationRole as OrganizationRoleEntity;
use DateTime;
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
                ->setEntityUuids((array) $object->entity_uuids)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $organizationRole->setCreatedAt($date);
            }

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $organizationRole->setRole($role);
            $manager->persist($organizationRole);
        }

        $manager->flush();
    }
}
