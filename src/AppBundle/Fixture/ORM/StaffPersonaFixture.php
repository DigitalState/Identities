<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Staff;
use AppBundle\Entity\StaffPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

/**
 * Class StaffPersonaFixture
 */
abstract class StaffPersonaFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $staffPersonas = $this->parse($this->getResource());

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
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
