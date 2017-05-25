<?php

namespace Ds\Bundle\StaffBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\StaffBundle\Entity\Staff;

/**
 * Class LoadStaffData
 */
class LoadStaffData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $staffs = $this->parse(__DIR__.'/../../Resources/data/{server}/staffs.yml');

        foreach ($staffs as $staff) {
            $entity = new Staff;
            $entity
                ->setUuid($staff['uuid'])
                ->setOwner($staff['owner'])
                ->setOwnerUuid($staff['owner_uuid']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }
}
