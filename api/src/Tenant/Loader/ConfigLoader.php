<?php

namespace App\Tenant\Loader;

use Ds\Component\Config\Service\ConfigService;
use Ds\Component\Config\Tenant\Loader\Config;
use Ds\Component\Tenant\Loader\Loader;

/**
 * Class ConfigLoader
 */
final class ConfigLoader implements Loader
{
    use Config;

    /**
     * Constructor
     *
     * @param \Ds\Component\Config\Service\ConfigService $configService
     */
    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
        $this->path = '/srv/api/config/tenant/loader/config.yaml';
    }
}
