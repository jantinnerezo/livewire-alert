<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\ServiceProvider;

use Livewire\Component;

class LivewireAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-alert');

        Component::macro('alert', function ($type = 'success', $message = '', $options = []) {
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

        Component::macro('confirming', function ($title, $options = []) {
            $identifier = (string) Str::uuid();

            $this->dispatchBrowserEvent('asking', $identifier);

            $this->dispatchBrowserEvent($identifier, [
                'options' => collect($options)->except([
                    'onConfirmed',
                    'onCancelled'
                ])->toArray(),
                'onConfirmed' => $options['onConfirmed'],
                'onCancelled' => $options['onCancelled'],
            ]);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('livewire-alert', function () {
            return new LivewireAlert;
        });
    }
}
