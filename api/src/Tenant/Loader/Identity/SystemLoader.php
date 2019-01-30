<?php

namespace App\Tenant\Loader\Identity;

use App\Service\SystemService;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class SystemLoader
 */
final class SystemLoader implements Loader
{
    use System;

    /**
     * Constructor
     *
     * @param \App\Service\SystemService $systemService
     */
    public function __construct(SystemService $systemService)
    {
        $this->systemService = $systemService;
        $this->path = '/srv/api/config/tenant/loader/identity/system/identity.yaml';
    }
}
