<?php

namespace App\Fixture;

use App\Entity\BusinessUnit as BusinessUnitEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait BusinessUnit
 */
trait BusinessUnit
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
            $businessUnit = new BusinessUnitEntity;
            $businessUnit
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $businessUnit->setCreatedAt($date);
            }

            $manager->persist($businessUnit);
            $this->setReference($object->uuid, $businessUnit);
        }

        $manager->flush();
    }
}
