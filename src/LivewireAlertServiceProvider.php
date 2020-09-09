<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

class LivewireAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        Blade::directive('livewireAlertScripts', function () {
            return <<<'HTML'
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
                <script>
                    Livewire.on('success', options => {
                        Swal.fire({
                            ...options,
                            icon: 'success'
                        });
                    });

                    Livewire.on('warning', options => {
                        Swal.fire({
                            ...options,
                            icon: 'warning'
                        });
                    });

                    Livewire.on('info', options => {
                        Swal.fire({
                            ...options,
                            icon: 'info'
                        });
                    });

                    Livewire.on('error', options => {
                        Swal.fire({
                            ...options,
                            icon: 'error'
                        });
                    });
                </script>
            HTML;
        });

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'livewire-alert');

        // Register the main class to use with the facade
        $this->app->singleton('livewire-alert', function () {
            return new LivewireAlert;
        });
    }
}
