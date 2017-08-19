<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Individual;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class IndividualFixture
 */
abstract class IndividualFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $individuals = $this->parse($this->getResource());

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
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
