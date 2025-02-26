<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Tests;

use Livewire\Livewire;

class LivewireAlertTest extends TestCase
{
    public function testTitle(): void
    {
        Livewire::test(TestComponent::class)
            ->call('showAlert')
            ->assertDispatched('alert');
    }
}