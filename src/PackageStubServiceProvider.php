<?php

namespace laradev;

use Illuminate\Support\ServiceProvider;

final class PackageStubServiceProvider extends ServiceProvider
{
    const CONFIG_KEY = 'package-stub';
    
    public function register()
    {
        $this->app->make('config')->set(self::CONFIG_KEY.'.register', true);
    }
    
    public function boot()
    {
        $this->app->make('config')->set(self::CONFIG_KEY.'.boot', true);
    }
}

