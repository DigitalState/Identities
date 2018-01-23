<?php

namespace AppBundle\Fixtures\ORM;

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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/system/identities.yml';
    }
}
