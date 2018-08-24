<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\BusinessUnit;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class BusinessUnitFixture
 */
abstract class BusinessUnitFixture extends ResourceFixture
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
                $connection->exec('ALTER SEQUENCE app_bu_id_seq RESTART WITH 1');
                $connection->exec('ALTER SEQUENCE app_bu_trans_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $businessUnit = new BusinessUnit;
            $businessUnit
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setTenant($object->tenant);
            $manager->persist($businessUnit);
            $manager->flush();
        }
    }
}
