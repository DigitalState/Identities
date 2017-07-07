<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Anonymous;
use AppBundle\Entity\AnonymousPersona;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Migration\Fixture\ORM\ResourceFixture;

/**
 * Class LoadAnonymousPersonaData
 */
class LoadAnonymousPersonaData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $anonymousPersonas = $this->parse(__DIR__.'/../../Resources/data/{server}/anonymous_personas.yml');

        foreach ($anonymousPersonas as $anonymousPersona) {
            $entity = new AnonymousPersona;
            $entity
                ->setAnonymous($manager->getRepository(Anonymous::class)->findOneBy(['uuid' => $anonymousPersona['anonymous']]))
                ->setUuid($anonymousPersona['uuid'])
                ->setOwner($anonymousPersona['owner'])
                ->setOwnerUuid($anonymousPersona['owner_uuid'])
                ->setTitle($anonymousPersona['title'])
                ->setData($anonymousPersona['data']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }
}
