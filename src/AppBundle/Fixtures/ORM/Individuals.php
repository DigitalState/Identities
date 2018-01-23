<?php

namespace AppBundle\Fixtures\ORM;

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
        return 11;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/individual/identities.yml';
    }
}
