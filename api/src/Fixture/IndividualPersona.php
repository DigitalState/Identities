<?php

namespace App\Fixture;

use App\Entity\IndividualPersona as IndividualPersonaEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

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
        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $individual = $this->getReference($object->individual);

            if (!$individual) {
                throw new LogicException('Individual "'.$object->individual.'" does not exist.');
            }

            $persona = new IndividualPersonaEntity;
            $persona
                ->setIndividual($individual)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $persona->setCreatedAt($date);
            }

            $manager->persist($persona);
        }

        $manager->flush();
    }
}
