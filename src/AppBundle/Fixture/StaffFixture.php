<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\BusinessUnit;
use AppBundle\Entity\Staff;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;
use LogicException;

/**
 * Class StaffFixture
 */
abstract class StaffFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $staff = new Staff;
            $staff
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid);

            foreach ($object->business_units as $uuid) {
                $businessUnit = $manager->getRepository(BusinessUnit::class)->findOneBy(['uuid' => $uuid]);

                if (!$businessUnit) {
                    throw new LogicException('Business unit does not exist.');
                }

                $staff->addBusinessUnit($businessUnit);
            }

            $manager->persist($staff);
            $manager->flush();
        }
    }
}
