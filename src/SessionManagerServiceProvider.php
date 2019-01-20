<?php
/**
 * Created by PhpStorm.
 * User: Chusky
 * Date: 7/12/18
 * Time: 10:10
 */

namespace Jetiradoro\SessionManager;


use Illuminate\Support\ServiceProvider;
use Jetiradoro\SessionManager\Commands\SessionManagerConsole;

class SessionManagerServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->publishes([__DIR__."/../config/config.php" => config_path("session-manager.php")],'sm-config');
        $this->publishes([__DIR__."/resources/views" => resource_path('views/vendor/session-manager')],'sm-views');
        $this->publishes([__DIR__."/resources/assets" => public_path("vendor/session-manager")],'sm-public');


        if(env('SM_ROUTES',true)){
            $this->loadRoutesFrom(__DIR__."/routes/routes.php");
        }

        $this->loadViewsFrom(__DIR__.'/resources/views', 'session-manager');

        if ($this->app->runningInConsole()) {
            $this->commands([
                SessionManagerConsole::class
            ]);
        }
    }

    public function register(){
        $this->mergeConfigFrom(__DIR__.'/../config/config.php','session-manager');
    }
}