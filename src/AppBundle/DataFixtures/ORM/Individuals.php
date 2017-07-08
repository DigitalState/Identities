<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\IndividualFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Individuals
 */
class Individuals extends IndividualFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{server}/individual/identities.yml';
    }
}
