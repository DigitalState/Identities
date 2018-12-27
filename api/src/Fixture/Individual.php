<?php

namespace App\Fixture;

use App\Entity\Individual as IndividualEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait Individual
 */
trait Individual
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
            $individual = new IndividualEntity;
            $individual
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $this->getReference($uuid);

                if (!$role) {
                    throw new LogicException('Role "'.$uuid.'" does not exist.');
                }

                $individual->addRole($role);
            }

            $manager->persist($individual);
            $this->setReference($object->uuid, $individual);
        }

        $manager->flush();
    }
}
