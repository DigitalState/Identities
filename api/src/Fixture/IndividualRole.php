<?php

namespace App\Fixture;

use App\Entity\IndividualRole as IndividualRoleEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;
use LogicException;

/**
 * Trait IndividualRole
 */
trait IndividualRole
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

            $individualRole = new IndividualRoleEntity;
            $individualRole
                ->setIndividual($individual)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setEntityUuids((array) $object->entity_uuids)
                ->setTenant($object->tenant);

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $individualRole->setRole($role);
            $manager->persist($individualRole);
        }

        $manager->flush();
    }
}
