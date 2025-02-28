<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Tests;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class TestComponent extends Component
{   
    public function testAlert(): void
    {
        LivewireAlert::title('Test Title')
            ->text('Test Text')
            ->success()
            ->show();
    }

    public function render()
    {
        return '<div></div>';
    }
}
