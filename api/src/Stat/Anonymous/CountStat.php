<?php

namespace App\Stat\Anonymous;

use App\Service\AnonymousService;
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
     * @var \App\Service\AnonymousService
     */
    private $anonymousService;

    /**
     * Constructor
     *
     * @param \App\Service\AnonymousService $anonymousService
     */
    public function __construct(AnonymousService $anonymousService)
    {
        $this->anonymousService = $anonymousService;
    }

    /**
     * {@inheritdoc}
     */
    public function get(): Datum
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->anonymousService->getRepository()->getCount([]));

        return $datum;
    }
}
