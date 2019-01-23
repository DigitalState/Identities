<?php

namespace App\Tenant\Loader;

use App\Service\RoleService;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class RoleLoader
 */
final class RoleLoader implements Loader
{
    use Role;

    /**
     * Constructor
     *
     * @param \App\Service\RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->path = '/srv/api/config/tenant/loader/role.yaml';
    }
}
