<?php

namespace App\Fixture;

use App\Entity\StaffPersona as StaffPersonaEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

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
        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $staff = $this->getReference($object->staff);

            if (!$staff) {
                throw new LogicException('Staff "'.$object->staff.'" does not exist.');
            }

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
