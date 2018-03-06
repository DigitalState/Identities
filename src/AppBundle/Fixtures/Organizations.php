<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\OrganizationFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Organizations
 */
class Organizations extends OrganizationFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/identity/organization/identities.yml';
    }
}
