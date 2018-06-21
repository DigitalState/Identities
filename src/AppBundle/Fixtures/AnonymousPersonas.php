<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\AnonymousPersonaFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class AnonymousPersonas
 */
class AnonymousPersonas extends AnonymousPersonaFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 22;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/identity/anonymous/personas.yml';
    }
}
