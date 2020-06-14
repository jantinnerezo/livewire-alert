<?php

namespace Jantinnerezo\LivewireAlert\Tests;

use Orchestra\Testbench\TestCase as BaseCase;
use Jantinnerezo\LivewireAlert\LivewireAlertServiceProvider;

class TestCase extends BaseCase
{
    protected function getPackageProviders($app)
    {
        return [LivewireAlertServiceProvider::class];
    }
}
