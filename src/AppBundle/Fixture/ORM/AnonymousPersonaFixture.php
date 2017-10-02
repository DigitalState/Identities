<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Anonymous;
use AppBundle\Entity\AnonymousPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

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
        $anonymousPersonas = $this->parse($this->getResource());

        foreach ($anonymousPersonas as $anonymousPersona) {
            $entity = new AnonymousPersona;
            $entity
                ->setAnonymous($manager->getRepository(Anonymous::class)->findOneBy(['uuid' => $anonymousPersona['anonymous']]))
                ->setUuid($anonymousPersona['uuid'])
                ->setOwner($anonymousPersona['owner'])
                ->setOwnerUuid($anonymousPersona['owner_uuid'])
                ->setIdentity($anonymousPersona['identity'])
                ->setIdentityUuid($anonymousPersona['identity_uuid'])
                ->setTitle($anonymousPersona['title'])
                ->setData($anonymousPersona['data']);
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
