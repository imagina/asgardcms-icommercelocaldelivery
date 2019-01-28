<?php

namespace Modules\Icommercelocaldelivery\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Icommercelocaldelivery\Events\Handlers\RegisterIcommercelocaldeliverySidebar;

class IcommercelocaldeliveryServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterIcommercelocaldeliverySidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('icommercelocaldeliveries', array_dot(trans('icommercelocaldelivery::icommercelocaldeliveries')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('icommercelocaldelivery', 'permissions');
        $this->publishConfig('icommercelocaldelivery', 'config');

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
            'Modules\Icommercelocaldelivery\Repositories\IcommerceLocalDeliveryRepository',
            function () {
                $repository = new \Modules\Icommercelocaldelivery\Repositories\Eloquent\EloquentIcommerceLocalDeliveryRepository(new \Modules\Icommercelocaldelivery\Entities\IcommerceLocalDelivery());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Icommercelocaldelivery\Repositories\Cache\CacheIcommerceLocalDeliveryDecorator($repository);
            }
        );
// add bindings

    }
}
