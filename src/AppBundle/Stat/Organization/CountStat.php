<?php

namespace AppBundle\Stat\Organization;

use AppBundle\Service\OrganizationService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \AppBundle\Service\OrganizationService
     */
    protected $organizationService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\OrganizationService $organizationService
     */
    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->organizationService->getRepository()->getCount([]));

        return $datum;
    }
}
