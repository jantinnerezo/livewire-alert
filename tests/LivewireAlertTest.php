<?php

namespace Jantinnerezo\LivewireAlert\Tests;

use Livewire\Livewire;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LivewireAlertTest extends TestCase
{
    public function testBasicAlert(): void
    {
        Livewire::test(LivewireAlert::class)
            ->call('showAlert')
            ->assertDispatchedBrowserEvent('alert');
    }

    public function testBasicFlashAlert(): void
    {
        Livewire::test(LivewireAlert::class)
            ->set('flash', true)
            ->call('showAlert')
            ->assertRedirect('/')
            ->assertSessionHas('livewire-alert');
    }

    public function testAlertConfirm(): void
    {
        Livewire::test(LivewireAlert::class)
            ->set('configuration.showConfirmButton', true)
            ->set('configuration.onConfirmed', 'confirmed')
            ->call('showConfirmAlert')
            ->emit('confirmed')
            ->assertDispatchedBrowserEvent('alert');
    }

    public function testAlertDenied(): void
    {
        Livewire::test(LivewireAlert::class)
            ->set('configuration.showDenyButton', true)
            ->set('configuration.onDenied', 'denied')
            ->call('showAlert')
            ->emit('denied')
            ->assertDispatchedBrowserEvent('alert');
    }

    public function testAlertDismissed(): void
    {
        Livewire::test(LivewireAlert::class)
            ->set('configuration.showCancelButton', true)
            ->set('configuration.onDismissed', 'dismissed')
            ->call('showAlert')
            ->emit('dismissed')
            ->assertDispatchedBrowserEvent('alert');
    }

    public function testProgressDismissal(): void
    {
        Livewire::test(LivewireAlert::class)
            ->set('configuration.timerProgressBar', true)
            ->set('configuration.timer', 3000)
            ->set('configuration.onProgressFinished', 'progressFinished')
            ->call('showAlert')
            ->emit('progressFinished')
            ->assertDispatchedBrowserEvent('alert');
    }
}