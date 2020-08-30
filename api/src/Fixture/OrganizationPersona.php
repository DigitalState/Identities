<?php

namespace App\Fixture;

use App\Entity\OrganizationPersona as OrganizationPersonaEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait OrganizationPersona
 */
trait OrganizationPersona
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
            $organization = $this->getReference($object->organization);

            if (!$organization) {
                throw new LogicException('Organization "'.$object->organization.'" does not exist.');
            }

            $persona = new OrganizationPersonaEntity;
            $persona
                ->setOrganization($organization)
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
            $manager->flush();
        }
    }
}
