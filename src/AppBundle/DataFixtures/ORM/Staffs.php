<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\StaffFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Staffs
 */
class Staffs extends StaffFixture implements OrderedFixtureInterface
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
        return __DIR__.'/../../Resources/data/{server}/staff/identities.yml';
    }
}
