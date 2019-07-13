<?php

namespace App\Tenant\Loader\Identity;

use App\Service\StaffRoleService;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class StaffRoleLoader
 */
final class StaffRoleLoader implements Loader
{
    use StaffRole;

    /**
     * Constructor
     *
     * @param \App\Service\StaffRoleService $staffRoleService
     */
    public function __construct(StaffRoleService $staffRoleService)
    {
        $this->staffRoleService = $staffRoleService;
        $this->path = '/srv/api/config/tenant/loader/identity/staff/role.yaml';
    }
}
