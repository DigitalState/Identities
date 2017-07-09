<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\SystemFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Systems
 */
class Systems extends SystemFixture implements OrderedFixtureInterface
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
        return __DIR__.'/../../Resources/data/{server}/system/identities.yml';
    }
}
