<?php

namespace App\Tenant\Loader\Identity;

use App\Service\StaffService;
use Ds\Component\Tenant\Entity\Tenant;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class StaffLoader
 */
final class StaffLoader implements Loader
{
    /**
     * @var \App\Service\StaffService
     */
    private $staffService;

    /**
     * Constructor
     *
     * @param \App\Service\StaffService $staffService
     */
    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Tenant $tenant)
    {
        $yml = file_get_contents('/srv/api-platform/src/App/Resources/tenant/identity/staff/identities.yml');

        // @todo Figure out how symfony does parameter binding and use the same technique
        $yml = strtr($yml, [
            '%identity.admin.uuid%' => $tenant->getData()['identity']['admin']['uuid'],
            '%business_unit.administration.uuid%' => $tenant->getData()['business_unit']['administration']['uuid'],
            '%tenant.uuid%' => $tenant->getUuid()
        ]);

        $staffs = Yaml::parse($yml, YAML::PARSE_OBJECT_FOR_MAP);
        $manager = $this->staffService->getManager();

        foreach ($staffs->objects as $object) {
            $object = (object) array_merge((array) $staffs->prototype, (array) $object);
            $staff = $this->staffService->createInstance();
            $staff
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);
            $manager->persist($staff);
            $manager->flush();
        }
    }
}
