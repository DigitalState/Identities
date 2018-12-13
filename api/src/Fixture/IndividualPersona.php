<?php

namespace App\Fixture;

use App\Entity\IndividualPersona as IndividualPersonaEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait IndividualPersona
 */
trait IndividualPersona
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
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_individual_persona_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_individual_persona_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $individual = $manager->getRepository(Individual::class)->findOneBy(['uuid' => $object->individual]);
            $persona = new IndividualPersonaEntity;
            $persona
                ->setIndividual($individual)
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
