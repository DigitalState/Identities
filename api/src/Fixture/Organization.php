<?php

namespace App\Fixture;

use App\Entity\Organization as OrganizationEntity;
use App\Entity\Role;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Organization
 */
trait Organization
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
            $organization = new OrganizationEntity;
            $organization
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $manager->getRepository(Role::class)->findOneBy(['uuid' => $uuid]);

                if (!$role) {
                    throw new LogicException('Role does not exist.');
                }

                $organization->addRole($role);
            }

            $manager->persist($organization);
            $manager->flush();
        }
    }
}
