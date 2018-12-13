<?php

namespace App\Fixture;

use App\Entity\AnonymousPersona as AnonymousPersonaEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

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
        $connection = $manager->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        switch ($platform) {
            case 'postgresql':
                $connection->exec('ALTER SEQUENCE app_anonymous_persona_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_anonymous_persona_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $anonymous = $manager->getRepository(Anonymous::class)->findOneBy(['uuid' => $object->anonymous]);
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
