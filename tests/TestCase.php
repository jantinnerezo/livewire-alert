<?php

namespace Jantinnerezo\LivewireAlert\Tests;

use Livewire\LivewireServiceProvider;
use Jantinnerezo\LivewireAlert\LivewireAlertServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LivewireAlertServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:9BLvxrqZjcRwnrHzaI4gOvRaSs2GBQodhp6snnDFEqc=');
    }

}
