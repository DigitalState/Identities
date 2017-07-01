<?php

namespace AppBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\BusinessUnit;

/**
 * Class LoadBusinessUnitData
 */
class LoadBusinessUnitData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $businessUnits = $this->parse(__DIR__.'/../../Resources/data/{server}/business_units.yml');

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
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
