<?php

namespace Dakele\Weather;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Weather::class, function(){
            return new Weather(config('services.weather.key'));
        });

        $this->app->alias([Weather::class, 'weather',Ipinfo::class, 'ipinfo']);
    }

    public function provides()
    {
        return [Weather::class, 'weather',Ipinfo::class, 'ipinfo'];
    }
}