<?php

namespace AppBundle\Tenant\Loader;

use AppBundle\Service\BusinessUnitService;
use Ds\Component\Tenant\Entity\Tenant;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class BusinessUnitLoader
 */
class BusinessUnitLoader implements Loader
{
    /**
     * @var \AppBundle\Service\BusinessUnitService
     */
    protected $businessUnitService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\BusinessUnitService $businessUnitService
     */
    public function __construct(BusinessUnitService $businessUnitService)
    {
        $this->businessUnitService = $businessUnitService;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Tenant $tenant)
    {
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/tenant/business_units.yml');

        // @todo Figure out how symfony does parameter binding and use the same technique
        $yml = strtr($yml, [
            '%business_unit.administration.uuid%' => $tenant->getData()['business_unit']['administration']['uuid'],
            '%tenant.uuid%' => $tenant->getUuid()
        ]);

        $businessUnits = Yaml::parse($yml, YAML::PARSE_OBJECT_FOR_MAP);
        $manager = $this->businessUnitService->getManager();

        foreach ($businessUnits->objects as $object) {
            $object = (object) array_merge((array) $businessUnits->prototype, (array) $object);
            $businessUnit = $this->businessUnitService->createInstance();
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
