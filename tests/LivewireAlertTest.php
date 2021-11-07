<?php

namespace Jantinnerezo\LivewireAlert\Tests;

use Jantinnerezo\LivewireAlert\Exceptions\AlertException;
use Livewire\Livewire;

class LivewireAlertTest extends TestCase
{
    public function testBasicAlert(): void
    {
        Livewire::test(TestComponent::class)
            ->call('showAlert')
            ->assertDispatchedBrowserEvent('alert');
    }

    public function testBasicFlashAlert(): void
    {
        Livewire::test(TestComponent::class)
            ->set('flash', true)
            ->call('showAlert')
            ->assertRedirect('/')
            ->assertSessionHas('livewire-alert');
    }

    public function testAlertConfirm(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.showConfirmButton', true)
            ->set('configuration.onConfirmed', 'confirmed')
            ->call('showConfirmAlert')
            ->assertDispatchedBrowserEvent('alert')
            ->emit('confirmed');
    }

    public function testAlertDenied(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.showDenyButton', true)
            ->set('configuration.onDenied', 'denied')
            ->call('showAlert')
            ->assertDispatchedBrowserEvent('alert')
            ->emit('denied');
    }

    public function testAlertDismissed(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.showCancelButton', true)
            ->set('configuration.onDismissed', 'dismissed')
            ->call('showAlert')
            ->assertDispatchedBrowserEvent('alert')
            ->emit('dismissed');
    }

    public function testProgressDismissal(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.timerProgressBar', true)
            ->set('configuration.timer', 3000)
            ->set('configuration.onProgressFinished', 'progressFinished')
            ->call('showAlert')
            ->assertDispatchedBrowserEvent('alert')
            ->emit('progressFinished');
    }

    public function testIfExceptionIsThrownWhenIconIsInvalid()
    {
        $invalidIcon = 'failed';
        
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Invalid '{$invalidIcon}' alert icon.");
        
        Livewire::test(TestComponent::class)
            ->set('status', $invalidIcon)
            ->call('showAlert');
    }
}