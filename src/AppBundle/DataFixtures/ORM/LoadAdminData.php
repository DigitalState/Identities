<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Admin;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

/**
 * Class LoadAdminData
 */
class LoadAdminData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $admins = $this->parse(__DIR__.'/../../Resources/data/{server}/admins.yml');

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
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
