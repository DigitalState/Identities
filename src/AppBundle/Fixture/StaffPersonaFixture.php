<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Staff;
use AppBundle\Entity\StaffPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

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
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_staff_persona_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_staff_persona_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $staff = $manager->getRepository(Staff::class)->findOneBy(['uuid' => $object->staff]);
            $persona = new StaffPersona;
            $persona
                ->setStaff($staff)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($persona);
            $manager->flush();
        }
    }
}
