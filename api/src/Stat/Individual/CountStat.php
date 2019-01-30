<?php

namespace App\Stat\Individual;

use App\Service\IndividualService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
final class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \App\Service\IndividualService
     */
    private $individualService;

    /**
     * Constructor
     *
     * @param \App\Service\IndividualService $individualService
     */
    public function __construct(IndividualService $individualService)
    {
        $this->individualService = $individualService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): Datum
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->individualService->getRepository()->getCount([]));

        return $datum;
    }
}
