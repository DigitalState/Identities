<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Individual;
use AppBundle\Entity\IndividualPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class IndividualPersonaFixture
 */
abstract class IndividualPersonaFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $individualPersonas = $this->parse($this->getResource());

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
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
