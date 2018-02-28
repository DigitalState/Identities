<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\StaffPersonaFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class StaffPersonas
 */
class StaffPersonas extends StaffPersonaFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 12;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/staff/personas.yml';
    }
}
