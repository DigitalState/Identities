<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Staff;
use AppBundle\Entity\StaffPersona;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

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
