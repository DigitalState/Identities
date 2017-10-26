<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\IndividualPersonaFixture;
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
        return __DIR__.'/../../Resources/data/{env}/individual/personas.yml';
    }
}
