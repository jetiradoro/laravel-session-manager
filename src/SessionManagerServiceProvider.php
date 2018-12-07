<?php
/**
 * Created by PhpStorm.
 * User: Chusky
 * Date: 7/12/18
 * Time: 10:10
 */

namespace Jetiradoro\SessionManager;


use Illuminate\Support\ServiceProvider;

class SessionManagerServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->publishes([
            __DIR__."/../config/config.php" => config_path("session-manager.php")
        ],'config');
    }

    public function register(){
        $this->mergeConfigFrom(__DIR__.'/../config/config.php','session-manager');
    }
}