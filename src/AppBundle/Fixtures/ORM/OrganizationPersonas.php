<?php

namespace AppBundle\Fixtures\ORM;

use AppBundle\Fixture\ORM\OrganizationPersonaFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class OrganizationPersonas
 */
class OrganizationPersonas extends OrganizationPersonaFixture implements OrderedFixtureInterface
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
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/organization/personas.yml';
    }
}
