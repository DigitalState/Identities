<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\StaffPersonaFixture;
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
        return '/srv/api-platform/src/AppBundle/Resources/data/{env}/staff/personas.yml';
    }
}
