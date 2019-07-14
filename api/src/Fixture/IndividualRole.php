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
                ->setTenant($object->tenant);

            $role = $this->getReference($object->role);

            if (!$role) {
                throw new LogicException('Role "'.$object->role.'" does not exist.');
            }

            $individualRole->setRole($role);

            foreach ($object->business_units as $uuid) {
                $businessUnit = $this->getReference($uuid);

                if (!$businessUnit) {
                    throw new LogicException('Business Unit "'.$uuid.'" does not exist.');
                }

                $individualRole->addBusinessUnit($businessUnit);
            }

            $manager->persist($individualRole);
        }

        $manager->flush();
    }
}
