<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Individual;
use AppBundle\Entity\Role;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;
use LogicException;

/**
 * Class IndividualFixture
 */
abstract class IndividualFixture extends ResourceFixture
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
                $connection->exec('ALTER SEQUENCE app_individual_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $individual = new Individual;
            $individual
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $manager->getRepository(Role::class)->findOneBy(['uuid' => $uuid]);

                if (!$role) {
                    throw new LogicException('Role does not exist.');
                }

                $individual->addRole($role);
            }

            $manager->persist($individual);
            $manager->flush();
        }
    }
}
