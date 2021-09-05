<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Strategy\SendMessage;
use App\Strategy\SmsNotification;
use App\Strategy\EmailNotifcation;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->request->getMethod() === "GET") {
            $this->app->bind(
                'App\Strategy\SendMessage',
                'App\Strategy\EmailNotifcation'
            );
        } else {
            $this->app->bind(
                'App\Strategy\SendMessage',
                'App\Strategy\SmsNotification'
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
