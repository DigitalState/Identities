<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\BusinessUnitFixture;
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
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/business_units.yml';
    }
}
