<?php

namespace AppBundle\Stat\Staff;

use AppBundle\Service\StaffService;
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
     * @var \AppBundle\Service\StaffService
     */
    protected $staffService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\StaffService $staffService
     */
    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->staffService->getRepository()->getCount([]));

        return $datum;
    }
}
