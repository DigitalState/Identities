<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Anonymous;
use AppBundle\Entity\Role;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;
use LogicException;

/**
 * Class AnonymousFixture
 */
abstract class AnonymousFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $anonymous = new Anonymous;
            $anonymous
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $manager->getRepository(Role::class)->findOneBy(['uuid' => $uuid]);

                if (!$role) {
                    throw new LogicException('Role does not exist.');
                }

                $anonymous->addRole($role);
            }

            $manager->persist($anonymous);
            $manager->flush();
        }
    }
}
