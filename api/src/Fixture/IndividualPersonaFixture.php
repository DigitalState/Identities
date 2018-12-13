<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class IndividualPersonaFixture
 */
final class IndividualPersonaFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use IndividualPersona;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/identity/individual/persona.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 22;
    }
}
