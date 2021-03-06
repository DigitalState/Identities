<?php

namespace App\Fixture;

use App\Entity\AnonymousPersona as AnonymousPersonaEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait AnonymousPersona
 */
trait AnonymousPersona
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
            $anonymous = $this->getReference($object->anonymous);

            if (!$anonymous) {
                throw new LogicException('Anonymous "'.$object->anonymous.'" does not exist.');
            }

            $persona = new AnonymousPersonaEntity;
            $persona
                ->setAnonymous($anonymous)
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
