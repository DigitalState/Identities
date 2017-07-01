<?php

namespace AppBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Individual;
use AppBundle\Entity\IndividualPersona;

/**
 * Class LoadIndividualPersonaData
 */
class LoadIndividualPersonaData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $individualPersonas = $this->parse(__DIR__.'/../../Resources/data/{server}/individual_personas.yml');

        foreach ($individualPersonas as $individualPersona) {
            $entity = new IndividualPersona;
            $entity
                ->setIndividual($manager->getRepository(Individual::class)->findOneBy(['uuid' => $individualPersona['individual']]))
                ->setUuid($individualPersona['uuid'])
                ->setOwner($individualPersona['owner'])
                ->setOwnerUuid($individualPersona['owner_uuid'])
                ->setTitle($individualPersona['title'])
                ->setData($individualPersona['data']);
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
