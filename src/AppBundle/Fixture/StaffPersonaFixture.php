<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Staff;
use AppBundle\Entity\StaffPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class StaffPersonaFixture
 */
abstract class StaffPersonaFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $staffPersona = new StaffPersona;
            $staffPersona
                ->setStaff($manager->getRepository(Staff::class)->findOneBy(['uuid' => $object->staff]))
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($staffPersona);
            $manager->flush();
        }
    }
}
