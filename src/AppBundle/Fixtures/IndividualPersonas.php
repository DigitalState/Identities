<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\IndividualPersonaFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class IndividualPersonas
 */
class IndividualPersonas extends IndividualPersonaFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/identity/individual/personas.yml';
    }
}
