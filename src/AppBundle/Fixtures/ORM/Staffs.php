<?php

namespace AppBundle\Fixtures\ORM;

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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/staff/identities.yml';
    }
}
