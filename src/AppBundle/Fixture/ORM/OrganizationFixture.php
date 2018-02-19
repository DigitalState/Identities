<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Organization;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class OrganizationFixture
 */
abstract class OrganizationFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $organizations = $this->parse($this->getResource());

        foreach ($organizations as $organization) {
            $entity = new Organization;
            $entity
                ->setUuid($organization['uuid'])
                ->setOwner($organization['owner'])
                ->setOwnerUuid($organization['owner_uuid']);
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
