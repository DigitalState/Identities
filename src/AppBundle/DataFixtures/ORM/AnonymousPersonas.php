<?php

namespace AppBundle\DataFixtures\ORM;

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
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{server}/anonymous/personas.yml';
    }
}