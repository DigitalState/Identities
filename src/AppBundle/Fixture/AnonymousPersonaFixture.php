<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Anonymous;
use AppBundle\Entity\AnonymousPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class AnonymousPersonaFixture
 */
abstract class AnonymousPersonaFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $anonymousPersona = new AnonymousPersona;
            $anonymousPersona
                ->setAnonymous($manager->getRepository(Anonymous::class)->findOneBy(['uuid' => $object->anonymous]))
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($anonymousPersona);
            $manager->flush();
        }
    }
}
