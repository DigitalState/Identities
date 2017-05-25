<?php

namespace Ds\Bundle\IndividualBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\IndividualBundle\Entity\Individual;

/**
 * Class LoadIndividualData
 */
class LoadIndividualData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $individuals = $this->parse(__DIR__.'/../../Resources/data/{server}/individuals.yml');

        foreach ($individuals as $individual) {
            $entity = new Individual;
            $entity
                ->setUuid($individual['uuid'])
                ->setOwner($individual['owner'])
                ->setOwnerUuid($individual['owner_uuid']);
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
