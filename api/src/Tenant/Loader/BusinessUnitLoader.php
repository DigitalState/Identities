<?php

namespace App\Tenant\Loader;

use App\Service\BusinessUnitService;
use Ds\Component\Tenant\Entity\Tenant;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class BusinessUnitLoader
 */
final class BusinessUnitLoader implements Loader
{
    use BusinessUnit;

    /**
     * Constructor
     *
     * @param \App\Service\BusinessUnitService $businessUnitService
     */
    public function __construct(BusinessUnitService $businessUnitService)
    {
        $this->businessUnitService = $businessUnitService;
        $this->path = '/srv/api/config/tenant/loader/business_unit.yaml';
    }
}
