<?php

namespace Modules\Itourism\Repositories\Cache;

use Modules\Itourism\Repositories\PlanRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePlanDecorator extends BaseCacheDecorator implements PlanRepository
{
    public function __construct(PlanRepository $plan)
    {
        parent::__construct();
        $this->entityName = 'itourism.plans';
        $this->repository = $plan;
    }
}
