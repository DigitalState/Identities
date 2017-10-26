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
        return __DIR__.'/../../Resources/data/{env}/staff/personas.yml';
    }
}
