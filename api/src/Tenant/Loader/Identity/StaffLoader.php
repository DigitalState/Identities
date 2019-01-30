<?php

namespace App\Tenant\Loader\Identity;

use App\Service\StaffService;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class StaffLoader
 */
final class StaffLoader implements Loader
{
    use Staff;

    /**
     * Constructor
     *
     * @param \App\Service\StaffService $staffService
     */
    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
        $this->path = '/srv/api/config/tenant/loader/identity/staff/identity.yaml';
    }
}
