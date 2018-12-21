<?php

namespace App\Fixture;

use App\Entity\Individual as IndividualEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

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
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $individual = new IndividualEntity;
            $individual
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $manager->getRepository(Role::class)->findOneBy(['uuid' => $uuid]);

                if (!$role) {
                    throw new LogicException('Role does not exist.');
                }

                $individual->addRole($role);
            }

            $manager->persist($individual);
        }

        $manager->flush();
    }
}
