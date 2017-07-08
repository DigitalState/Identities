<?php

namespace AppBundle\DataFixtures\ORM;

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
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{server}/staff/personas.yml';
    }
}
