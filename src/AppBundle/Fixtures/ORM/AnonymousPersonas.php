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
        return __DIR__.'/../../Resources/data/{env}/anonymous/personas.yml';
    }
}
