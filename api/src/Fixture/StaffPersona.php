<?php

namespace App\Fixture;

use App\Entity\StaffPersona as StaffPersonaEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait StaffPersona
 */
trait StaffPersona
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $staff = $manager->getRepository(Staff::class)->findOneBy(['uuid' => $object->staff]);
            $persona = new StaffPersonaEntity;
            $persona
                ->setStaff($staff)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($persona);
        }

        $manager->flush();
    }
}
