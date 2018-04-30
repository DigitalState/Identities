<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\System;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class SystemFixture
 */
abstract class SystemFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $system = new System;
            $system
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid);
            $manager->persist($system);
            $manager->flush();
        }
    }
}
