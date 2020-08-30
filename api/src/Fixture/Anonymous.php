<?php

namespace App\Fixture;

use App\Entity\Anonymous as AnonymousEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Anonymous
 */
trait Anonymous
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
            $anonymous = new AnonymousEntity;
            $anonymous
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $anonymous->setCreatedAt($date);
            }

            $manager->persist($anonymous);
            $this->setReference($object->uuid, $anonymous);
        }

        $manager->flush();
    }
}
