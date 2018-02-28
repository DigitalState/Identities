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
        $staffs = $this->parse($this->getResource());

        foreach ($staffs as $staff) {
            $entity = new Staff;
            $entity
                ->setUuid($staff['uuid'])
                ->setOwner($staff['owner'])
                ->setOwnerUuid($staff['owner_uuid']);

            foreach ($staff['business_units'] as $businessUnit) {
                $businessUnit = $manager->getRepository(BusinessUnit::class)->findOneBy(['uuid' => $businessUnit]);

                if (!$businessUnit) {
                    throw new LogicException('Business unit does not exist.');
                }

                $entity->addBusinessUnit($businessUnit);
            }

            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
