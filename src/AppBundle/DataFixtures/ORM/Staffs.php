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
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{env}/staff/identities.yml';
    }
}
