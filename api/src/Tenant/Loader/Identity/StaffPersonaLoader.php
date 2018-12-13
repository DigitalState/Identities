<?php

namespace App\Tenant\Loader\Identity;

use App\Entity\Staff;
use App\Service\StaffPersonaService;
use Ds\Component\Tenant\Entity\Tenant;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class StaffPersonaLoader
 */
final class StaffPersonaLoader implements Loader
{
    /**
     * @var \App\Service\StaffPersonaService
     */
    private $staffPersonaService;

    /**
     * Constructor
     *
     * @param \App\Service\StaffPersonaService $staffPersonaService
     */
    public function __construct(StaffPersonaService $staffPersonaService)
    {
        $this->staffPersonaService = $staffPersonaService;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Tenant $tenant)
    {
        $yml = file_get_contents('/srv/api-platform/src/App/Resources/tenant/identity/staff/personas.yml');

        // @todo Figure out how symfony does parameter binding and use the same technique
        $yml = strtr($yml, [
            '%identity.admin.uuid%' => $tenant->getData()['identity']['admin']['uuid'],
            '%business_unit.administration.uuid%' => $tenant->getData()['business_unit']['administration']['uuid'],
            '%tenant.uuid%' => $tenant->getUuid()
        ]);

        $personas = Yaml::parse($yml, YAML::PARSE_OBJECT_FOR_MAP);
        $manager = $this->staffPersonaService->getManager();

        foreach ($personas->objects as $object) {
            $object = (object) array_merge((array) $personas->prototype, (array) $object);
            $staff = $manager->getRepository(Staff::class)->findOneBy(['uuid' => $object->staff]);
            $persona = $this->staffPersonaService->createInstance();
            $persona
                ->setStaff($staff)
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($persona);
            $manager->flush();
        }
    }
}
