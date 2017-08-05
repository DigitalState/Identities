<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\System;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class SystemFixture
 */
abstract class SystemFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $systems = $this->parse($this->getResource());

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
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
