<?php

namespace AppBundle\Tenant\Loader\Identity;

use AppBundle\Service\SystemService;
use Ds\Component\Tenant\Entity\Tenant;
use Ds\Component\Tenant\Loader\Loader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class SystemLoader
 */
class SystemLoader implements Loader
{
    /**
     * @var \AppBundle\Service\SystemService
     */
    protected $systemService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\SystemService $systemService
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
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/tenant/identity/system/identities.yml');

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
