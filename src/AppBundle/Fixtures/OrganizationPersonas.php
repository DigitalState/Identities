<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\OrganizationPersonaFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class OrganizationPersonas
 */
class OrganizationPersonas extends OrganizationPersonaFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 22;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/identity/organization/personas.yml';
    }
}
