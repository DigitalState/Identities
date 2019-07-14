<?php

namespace App\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class StaffRoleFixture
 */
final class StaffRoleFixture extends AbstractFixture implements FixtureInterface, SharedFixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    use StaffRole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->path = '/srv/api/config/fixtures/{fixtures}/identity/staff/role.yaml';
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 22;
    }
}
