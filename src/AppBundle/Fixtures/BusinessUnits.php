<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\BusinessUnitFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class BusinessUnits
 */
class BusinessUnits extends BusinessUnitFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/business_units.yml';
    }
}
