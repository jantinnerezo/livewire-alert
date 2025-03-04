<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Facades;

use Illuminate\Support\Facades\Facade;

class LivewireAlert extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewire-alert';
    }
}
