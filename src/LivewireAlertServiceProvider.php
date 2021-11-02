<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Livewire\Component;

class LivewireAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerAlertMacro();
        $this->registerFlashMacro();
        $this->registerPublishables();

        View::composer('livewire-alert::components.scripts', function ($view) {
            $view->jsPath = __DIR__.'/../public/livewire-alert.js';
        });

        Livewire::component('livewire-alert-demo', LivewireAlert::class);
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-alert');
    }

    protected function registerAlertMacro()
    {
        Component::macro('alert', function ($type = 'success', $message = '', $options = []) {
            $options = array_merge(
                config('livewire-alert.alert') ?? [],
                config('livewire-alert.' . $type) ?? [],
                $options
            );

            $this->dispatchBrowserEvent('alert', [
                'type' => $type,
                'message' => $message,
                'events' => Arr::only($options, [
                    'onConfirmed', 
                    'onDismissed', 
                    'onDenied',
                    'onProgressFinished'
                ]),
                'options' => Arr::except($options, [
                    'onConfirmed', 
                    'onDismissed', 
                    'onDenied',
                    'onProgressFinished'
                ])
            ]);
        });
    }

    public function registerFlashMacro()
    {
        Component::macro('flash', function ($type = 'success', $message = '', $options = []) {
            $options = array_merge(
                config('livewire-alert.alert') ?? [],
                config('livewire-alert.' . $type) ?? [],
                $options
            );

            session()->flash('livewire-alert', [
                'type' => $type,
                'message' => $message,
                'events' => Arr::only($options, [
                    'onConfirmed', 
                    'onDismissed', 
                    'onDenied',
                    'onProgressFinished'
                ]),
                'options' => Arr::except($options, [
                    'onConfirmed', 
                    'onDismissed', 
                    'onDenied',
                    'onProgressFinished'
                ])
            ]);
        });
    }

    public function registerPublishables()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('livewire-alert.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/')
            ], 'livewire-alert');
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
