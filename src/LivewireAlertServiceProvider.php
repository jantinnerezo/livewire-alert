<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
class LivewireAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerPublishables();
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-alert');

        View::composer('livewire-alert::components.scripts', function ($view) {
            $view->jsPath = __DIR__.'/../public/livewire-alert.js';
        });

        Livewire::component('livewire-alert-demo', LivewireAlert::class);
    }

    public function registerPublishables()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('livewire-alert.php'),
            ], 'livewire-alert:config');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/livewire-alert')
            ], 'livewire-alert:assets');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'livewire-alert');
    }
}
