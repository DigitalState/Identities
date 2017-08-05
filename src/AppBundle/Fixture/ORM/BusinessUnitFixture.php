<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\BusinessUnit;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

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
        $businessUnits = $this->parse($this->getResource());

        foreach ($businessUnits as $businessUnit) {
            $entity = new BusinessUnit;
            $entity
                ->setUuid($businessUnit['uuid'])
                ->setOwner($businessUnit['owner'])
                ->setOwnerUuid($businessUnit['owner_uuid'])
                ->setTitle($businessUnit['title']);
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
