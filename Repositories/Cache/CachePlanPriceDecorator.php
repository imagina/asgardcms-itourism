<?php

namespace Modules\Itourism\Repositories\Cache;

use Modules\Itourism\Repositories\PlanPriceRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePlanPriceDecorator extends BaseCacheDecorator implements PlanPriceRepository
{
    public function __construct(PlanPriceRepository $planprice)
    {
        parent::__construct();
        $this->entityName = 'itourism.planprices';
        $this->repository = $planprice;
    }
}
