<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Admin;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class AdminFixture
 */
abstract class AdminFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $admins = $this->parse($this->getResource());

        foreach ($admins as $admin) {
            $entity = new Admin;
            $entity
                ->setUuid($admin['uuid'])
                ->setOwner($admin['owner'])
                ->setOwnerUuid($admin['owner_uuid']);
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
