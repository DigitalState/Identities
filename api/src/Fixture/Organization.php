<?php

namespace App\Fixture;

use App\Entity\Organization as OrganizationEntity;
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
            $manager->persist($organization);
            $this->setReference($object->uuid, $organization);
        }

        $manager->flush();
    }
}
