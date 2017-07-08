<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\AdminFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Admins
 */
class Admins extends AdminFixture implements OrderedFixtureInterface
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
        return __DIR__.'/../../Resources/data/{server}/admin/identities.yml';
    }
}
