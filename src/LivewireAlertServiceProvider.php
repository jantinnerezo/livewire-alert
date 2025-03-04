<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\ServiceProvider;

class LivewireAlertServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPublishables();
    }

    public function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/livewire-alert.php' => config_path('livewire-alert.php'),
            ], 'livewire-alert:config');
        }
    }

    public function register(): void
    {
        $this->app->bind(LivewireAlert::class, function ($app) {
            return new LivewireAlert($app['livewire']->current());
        });

        $this->app->bind('livewire-alert', function ($app) {
            return new LivewireAlert($app['livewire']->current());
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/livewire-alert.php',
            'livewire-alert'
        );
    }
}
