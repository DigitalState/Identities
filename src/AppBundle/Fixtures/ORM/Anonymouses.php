<?php

namespace AppBundle\Fixtures\ORM;

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
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/anonymous/identities.yml';
    }
}
