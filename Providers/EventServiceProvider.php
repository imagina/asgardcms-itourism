<?php

namespace Modules\Itourism\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Itourism\Events\PlanWasCreated;
use Modules\Itourism\Events\PlanWasUpdated;
use Modules\Itourism\Events\Handlers\SavePlanImage;
use Modules\Itourism\Events\Handlers\SavePlanPrices;
use Modules\Itourism\Events\Handlers\UpdatePlanImage;
use Modules\Itourism\Events\Handlers\UpdatePlanPrices;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PlanWasCreated::class => [
            SavePlanImage::class,
            SavePlanPrices::class,
        ],
        PlanWasUpdated::class => [
            UpdatePlanImage::class,
            UpdatePlanPrices::class,
        ],
    ];
}
