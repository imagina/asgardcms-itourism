<?php

namespace Modules\Itourism\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Itourism\Events\Handlers\RegisterItourismSidebar;

class ItourismServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterItourismSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            //$event->load('plans', array_dot(trans('itourism::plans')));
            //$event->load('persontypes', array_dot(trans('itourism::persontypes')));
            //$event->load('roomtypes', array_dot(trans('itourism::roomtypes')));
            //$event->load('planprices', array_dot(trans('itourism::planprices')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('itourism', 'permissions');
        $this->publishConfig('itourism', 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Itourism\Repositories\PlanRepository',
            function () {
                $repository = new \Modules\Itourism\Repositories\Eloquent\EloquentPlanRepository(new \Modules\Itourism\Entities\Plan());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itourism\Repositories\Cache\CachePlanDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Itourism\Repositories\PersonTypesRepository',
            function () {
                $repository = new \Modules\Itourism\Repositories\Eloquent\EloquentPersonTypesRepository(new \Modules\Itourism\Entities\PersonTypes());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itourism\Repositories\Cache\CachePersonTypesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Itourism\Repositories\RoomTypesRepository',
            function () {
                $repository = new \Modules\Itourism\Repositories\Eloquent\EloquentRoomTypesRepository(new \Modules\Itourism\Entities\RoomTypes());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itourism\Repositories\Cache\CacheRoomTypesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Itourism\Repositories\PlanPriceRepository',
            function () {
                $repository = new \Modules\Itourism\Repositories\Eloquent\EloquentPlanPriceRepository(new \Modules\Itourism\Entities\PlanPrice());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Itourism\Repositories\Cache\CachePlanPriceDecorator($repository);
            }
        );
// add bindings




    }
}
