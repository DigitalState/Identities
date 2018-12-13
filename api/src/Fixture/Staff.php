<?php

namespace App\Fixture;

use App\Entity\Staff as StaffEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Staff
 */
trait Staff
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
                $connection->exec('ALTER SEQUENCE app_staff_id_seq RESTART WITH 1');
                break;
        }

        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $staff = new StaffEntity;
            $staff
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);

            foreach ($object->roles as $uuid) {
                $role = $manager->getRepository(Role::class)->findOneBy(['uuid' => $uuid]);

                if (!$role) {
                    throw new LogicException('Role does not exist.');
                }

                $staff->addRole($role);
            }

            foreach ($object->business_units as $uuid) {
                $businessUnit = $manager->getRepository(BusinessUnit::class)->findOneBy(['uuid' => $uuid]);

                if (!$businessUnit) {
                    throw new LogicException('Business unit does not exist.');
                }

                $staff->addBusinessUnit($businessUnit);
            }

            $manager->persist($staff);
        }

        $manager->flush();
    }
}
