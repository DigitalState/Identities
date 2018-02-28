<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Anonymous;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class AnonymousFixture
 */
abstract class AnonymousFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $anonymouses = $this->parse($this->getResource());

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
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
