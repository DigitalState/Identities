<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\AnonymousFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Anonymouses
 */
class Anonymouses extends AnonymousFixture implements OrderedFixtureInterface
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
        return __DIR__.'/../../Resources/data/{server}/anonymous/identities.yml';
    }
}
