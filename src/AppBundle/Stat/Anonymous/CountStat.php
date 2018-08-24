<?php

namespace AppBundle\Stat\Anonymous;

use AppBundle\Service\AnonymousService;
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
     * @var \AppBundle\Service\AnonymousService
     */
    protected $anonymousService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\AnonymousService $anonymousService
     */
    public function __construct(AnonymousService $anonymousService)
    {
        $this->anonymousService = $anonymousService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->anonymousService->getRepository()->getCount([]));

        return $datum;
    }
}
