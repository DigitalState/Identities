<?php

namespace App\Tenant\Loader\Identity;

use App\Service\StaffPersonaService;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class StaffPersonaLoader
 */
final class StaffPersonaLoader implements Loader
{
    use StaffPersona;

    /**
     * Constructor
     *
     * @param \App\Service\StaffPersonaService $staffPersonaService
     */
    public function __construct(StaffPersonaService $staffPersonaService)
    {
        $this->staffPersonaService = $staffPersonaService;
        $this->path = '/srv/api/config/tenant/loader/identity/staff/persona.yaml';
    }
}
