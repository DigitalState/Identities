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
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_individual_persona_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_individual_persona_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $individualPersona = new IndividualPersona;
            $individualPersona
                ->setIndividual($manager->getRepository(Individual::class)->findOneBy(['uuid' => $object->individual]))
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($individualPersona);
            $manager->flush();
        }
    }
}
