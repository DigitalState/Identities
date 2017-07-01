<?php

namespace AppBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Anonymous;

/**
 * Class LoadAnonymousData
 */
class LoadAnonymousData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $anonymouses = $this->parse(__DIR__.'/../../Resources/data/{server}/anonymouses.yml');

        foreach ($anonymouses as $anonymous) {
            $entity = new Anonymous;
            $entity
                ->setUuid($anonymous['uuid'])
                ->setOwner($anonymous['owner'])
                ->setOwnerUuid($anonymous['owner_uuid']);
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
