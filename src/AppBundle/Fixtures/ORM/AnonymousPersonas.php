<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\AnonymousPersonaFixture;
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
        return 12;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/anonymous/personas.yml';
    }
}
