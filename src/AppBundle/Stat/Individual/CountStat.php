<?php

namespace AppBundle\Stat\Individual;

use AppBundle\Service\IndividualService;
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
     * @var \AppBundle\Service\IndividualService
     */
    protected $individualService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\IndividualService $individualService
     */
    public function __construct(IndividualService $individualService)
    {
        $this->individualService = $individualService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->individualService->getRepository()->getCount([]));

        return $datum;
    }
}
