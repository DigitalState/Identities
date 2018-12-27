<?php

namespace App\Fixture;

use App\Entity\Anonymous as AnonymousEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait Anonymous
 */
trait Anonymous
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
            $anonymous = new AnonymousEntity;
            $anonymous
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $this->getReference($uuid);

                if (!$role) {
                    throw new LogicException('Role "'.$uuid.'" does not exist.');
                }

                $anonymous->addRole($role);
            }

            $manager->persist($anonymous);
            $this->setReference($object->uuid, $anonymous);
        }

        $manager->flush();
    }
}
