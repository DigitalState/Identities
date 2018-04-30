<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\BusinessUnit;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class BusinessUnitFixture
 */
abstract class BusinessUnitFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $businessUnit = new BusinessUnit;
            $businessUnit
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title);
            $manager->persist($businessUnit);
            $manager->flush();
        }
    }
}
