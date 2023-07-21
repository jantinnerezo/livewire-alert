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
            ->assertDispatched('alert');
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
            ->assertDispatched('alert')
            ->dispatch('confirmed');
    }

    public function testAlertDenied(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.showDenyButton', true)
            ->set('configuration.onDenied', 'denied')
            ->call('showAlert')
            ->assertDispatched('alert')
            ->dispatch('denied');
    }

    public function testAlertDismissed(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.showCancelButton', true)
            ->set('configuration.onDismissed', 'dismissed')
            ->call('showAlert')
            ->assertDispatched('alert')
            ->dispatch('dismissed');
    }

    public function testProgressDismissal(): void
    {
        Livewire::test(TestComponent::class)
            ->set('configuration.timerProgressBar', true)
            ->set('configuration.timer', 3000)
            ->set('configuration.onProgressFinished', 'progressFinished')
            ->call('showAlert')
            ->assertDispatched('alert')
            ->dispatch('progressFinished');
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

    public function testIfExceptionIsThrownWhenComponentKeyIsMissingOnConfirmedEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing component key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.showConfirmButton', true)
            ->set('configuration.onConfirmed',[
                'listener' => 'confirmed'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentListenerIsMissingOnConfirmedEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing listener key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onConfirmed',[
                'component' => 'demo'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentKeyIsMissingOnDeniedEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing component key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onDenied',[
                'listener' => 'denied'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentListenerIsMissingOnDeniedEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing listener key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onDenied',[
                'component' => 'demo'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentKeyIsMissingOnDismissedEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing component key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onDismissed',[
                'listener' => 'denied'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentListenerIsMissingOnDismissedEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing listener key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onDismissed',[
                'component' => 'demo'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentKeyIsMissingOnProgressEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing component key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onProgressFinished',[
                'listener' => 'denied'
            ])
            ->call('showAlert');
    }

    public function testIfExceptionIsThrownWhenComponentListenerIsMissingOnProgressEvent()
    {
        $this->expectException(AlertException::class);
        $this->expectExceptionMessage("Missing listener key on event properties");

        Livewire::test(TestComponent::class)
            ->set('configuration.onProgressFinished',[
                'component' => 'demo'
            ])
            ->call('showAlert');
    }
}