<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\ServiceProvider;

use Livewire\Component;

class LivewireAlertServiceProvider extends ServiceProvider
{
    protected $name = 'alert';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-alert');

        Component::macro($this->name, function ($type = 'success', $message = '', $options = []) {
            $this->dispatchBrowserEvent('alert', [
                'type' => $type,
                'message' => $message,
                'options' => $options
            ]);
        });
 
        Component::macro('flash', function ($type = 'success', $message = '', $options = []) {
            session()->flash('livewire-alert', [
                'type' => $type,
                'message' => $message,
                'options' => $options
            ]);
        });

        Component::macro('confirm', function ($title, $options = []) {
            $this->dispatchBrowserEvent('confirming', [
                'title' => $title,
                'options' => $options
            ]);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'livewire-alert');

        // Register the main class to use with the facade
        $this->app->singleton('livewire-alert', function () {
            return new LivewireAlert;
        });
    }
}
