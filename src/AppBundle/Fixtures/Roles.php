<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\RoleFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Roles
 */
class Roles extends RoleFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/roles.yml';
    }
}
