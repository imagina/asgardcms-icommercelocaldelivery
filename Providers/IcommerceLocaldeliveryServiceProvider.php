<?php

namespace Modules\IcommerceLocaldelivery\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\IcommerceLocaldelivery\Events\Handlers\RegisterIcommerceLocaldeliverySidebar;

class IcommerceLocaldeliveryServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterIcommerceLocaldeliverySidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('configlocaldeliveries', array_dot(trans('icommercelocaldelivery::configlocaldeliveries')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('IcommerceLocaldelivery', 'permissions');

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
            'Modules\IcommerceLocaldelivery\Repositories\ConfiglocaldeliveryRepository',
            function () {
                $repository = new \Modules\IcommerceLocaldelivery\Repositories\Eloquent\EloquentConfiglocaldeliveryRepository(new \Modules\IcommerceLocaldelivery\Entities\Configlocaldelivery());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\IcommerceLocaldelivery\Repositories\Cache\CacheConfiglocaldeliveryDecorator($repository);
            }
        );
// add bindings

    }
}
