<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\ServiceProvider;

use Livewire\Component;
use Illuminate\Support\Str;

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
        $this->registerConfirmMacro();
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-alert');
    }

    protected function registerAlertMacro()
    {
        Component::macro($this->name, function ($type = 'success', $message = '', $options = []) {
            $options = array_merge(config('livewire-alert'), $options);

            $this->dispatchBrowserEvent('alert', [
                'type' => $type,
                'message' => $message,
                'options' => $options
            ]);
        });
    }

    public function registerFlashMacro()
    {
        Component::macro('flash', function ($type = 'success', $message = '', $options = []) {
            $options = array_merge(config('livewire-alert'), $options);

            session()->flash('livewire-alert', [
                'type' => $type,
                'message' => $message,
                'options' => $options
            ]);
        });
    }

    public function registerConfirmMacro()
    {
        Component::macro('confirm', function ($title, $options = []) {
            $options = array_merge(config('livewire-alert'), $options);

            $identifier = (string) Str::uuid();

            // Dispatch unique event identifier
            $this->dispatchBrowserEvent('confirming', $identifier);

            // Set the title separated from defining a config
            $options['title'] = $title;

            // Dispatch the unique event identifier
            $this->dispatchBrowserEvent($identifier, [
                'options' => collect($options)->except([
                    'onConfirmed',
                    'onCancelled'
                ])->toArray(),
                'onConfirmed' => $options['onConfirmed'],
                'onCancelled' => $options['onCancelled'] ?? null
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
