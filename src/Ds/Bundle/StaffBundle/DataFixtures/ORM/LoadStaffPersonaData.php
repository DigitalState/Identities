<?php

namespace Ds\Bundle\StaffBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\StaffBundle\Entity\Staff;
use Ds\Bundle\StaffBundle\Entity\StaffPersona;

/**
 * Class LoadStaffPersonaData
 */
class LoadStaffPersonaData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $staffPersonas = $this->parse(__DIR__.'/../../Resources/data/{server}/staff_personas.yml');

        foreach ($staffPersonas as $staffPersona) {
            $entity = new StaffPersona;
            $entity
                ->setStaff($manager->getRepository(Staff::class)->findOneBy(['uuid' => $staffPersona['staff']]))
                ->setUuid($staffPersona['uuid'])
                ->setOwner($staffPersona['owner'])
                ->setOwnerUuid($staffPersona['owner_uuid'])
                ->setTitle($staffPersona['title'])
                ->setData($staffPersona['data']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }
}
