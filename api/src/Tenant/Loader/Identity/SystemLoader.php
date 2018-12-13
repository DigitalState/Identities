<?php

namespace App\Tenant\Loader\Identity;

use App\Service\SystemService;
use Ds\Component\Tenant\Entity\Tenant;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class SystemLoader
 */
final class SystemLoader implements Loader
{
    /**
     * @var \App\Service\SystemService
     */
    private $systemService;

    /**
     * Constructor
     *
     * @param \App\Service\SystemService $systemService
     */
    public function __construct(SystemService $systemService)
    {
        $this->systemService = $systemService;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Tenant $tenant)
    {
        $yml = file_get_contents('/srv/api-platform/src/App/Resources/tenant/identity/system/identities.yml');

        // @todo Figure out how symfony does parameter binding and use the same technique
        $yml = strtr($yml, [
            '%identity.system.uuid%' => $tenant->getData()['identity']['system']['uuid'],
            '%tenant.uuid%' => $tenant->getUuid()
        ]);

        $systems = Yaml::parse($yml, YAML::PARSE_OBJECT_FOR_MAP);
        $manager = $this->systemService->getManager();

        foreach ($systems->objects as $object) {
            $object = (object) array_merge((array) $systems->prototype, (array) $object);
            $system = $this->systemService->createInstance();
            $system
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTenant($object->tenant);
            $manager->persist($system);
            $manager->flush();
        }
    }
}
