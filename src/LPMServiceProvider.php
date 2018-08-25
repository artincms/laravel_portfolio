<?php

namespace ArtinCMS\LPM;

use Illuminate\Support\ServiceProvider;

class LPMServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
    	// the main router
        $this->loadRoutesFrom( __DIR__.'/Routes/backend_lpm_route.php');
        $this->loadRoutesFrom( __DIR__.'/Routes/frontend_lpm_route.php');

	    $this->publishes([
		    __DIR__ . '/Database/Migrations/' => database_path('migrations')
	    ], 'migrations');

        $this->loadViewsFrom(__DIR__ . '/Views', 'laravel_portfolio');
        // the main migration folder for create sms_ir tables

        // for publish the views into main app
        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/laravel_portfolio'),
        ]);

	    // for publish the assets files into main app
	    $this->publishes([
		    __DIR__.'/assets' => public_path('vendor/laravel_portfolio'),
	    ], 'public');

	    // for publish the sms_ir config file to the main app config folder
	    $this->publishes([
		    __DIR__ . '/Config/LPM.php' => config_path('laravel_portfolio.php'),
	    ]);


        // publish language
        $this->publishes([
            __DIR__ . '/Lang/En/laravel_portfolio.php' => resource_path('lang/en/laravel_portfolio.php'),
        ]);
        $this->publishes([
            __DIR__ . '/Lang/Fa/laravel_portfolio.php' => resource_path('lang/fa/laravel_portfolio.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	// set the main config file
	    $this->mergeConfigFrom(
		    __DIR__ . '/Config/LPM.php', 'laravel_portfolio_system'
	    );

		// bind the LCSC Facade
	    $this->app->bind('LPM', function () {
		    return new LPM;
	    });
    }
}
