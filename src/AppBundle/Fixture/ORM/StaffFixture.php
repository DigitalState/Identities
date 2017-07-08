<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Staff;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

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
