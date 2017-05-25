<?php

namespace Ds\Bundle\SystemBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\SystemBundle\Entity\System;

/**
 * Class LoadSystemData
 */
class LoadSystemData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $systems = $this->parse(__DIR__.'/../../Resources/data/{server}/systems.yml');

        foreach ($systems as $system) {
            $entity = new System;
            $entity
                ->setUuid($system['uuid'])
                ->setOwner($system['owner'])
                ->setOwnerUuid($system['owner_uuid']);
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
