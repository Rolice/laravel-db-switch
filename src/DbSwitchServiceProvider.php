<?php
namespace Rolice\LaravelDbSwitch;

use Illuminate\Support\ServiceProvider;

/**
 * Class DbSwitchServiceProvider
 * @package LaravelDbSwitch
 * @author Lyubomir Gardev <l.gardev@intellisys.org>
 * @version 1.0
 */
class DbSwitchServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('db.switch', function () {
            return new DbSwitchService;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['db.switch'];
    }

}
