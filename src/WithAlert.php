<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\Arr;

trait WithAlert
{
    public function confirm(string $title, $options = [])
    {
        $options = array_merge(
            config('livewire-alert.confirm'),
            $options,
        );

        $type = Arr::get($options, 'icon');
        
        $this->alert($type,$title, $options);
    }

    public function alert(string $type = 'success', string $message = '', array $options = [])
    {
        $this->dispatchOrFlashAlert([
            'type' => $type,
            'message' => $message,
            'options' => $options
        ]);
    }

    public function flash(string $type = 'success', string $message = '', array $options = [], $redirect = '/')
    {
        $this->dispatchOrFlashAlert([
            'type' => $type,
            'message' => $message,
            'options' => $options,
            'flash' => true
        ]);

        return redirect()->to($redirect);
    }

    protected function dispatchOrFlashAlert(array $configuration)
    {
        $type = Arr::get($configuration, 'type');
        $message = Arr::get($configuration, 'message');
        $options = Arr::get($configuration, 'options');
        $isFlash = Arr::has($configuration, 'flash') && Arr::get($configuration, 'flash') === true;

        $options = array_merge(
            config('livewire-alert.alert') ?? [],
            config('livewire-alert.' . $type) ?? [],
            $options
        );

        $payload = [
            'type' => $type,
            'message' => $message,
            'events' => Arr::only($options, $this->livewireAlertEvents()),
            'options' => Arr::except($options, $this->livewireAlertEvents())
        ];

        if (! $isFlash) {
            $this->dispatchBrowserEvent('alert', $payload);

            return;
        }
        
        session()->flash('livewire-alert', $payload);
    }

    protected function livewireAlertEvents(): array
    {
        return [
            'onConfirmed', 
            'onDismissed', 
            'onDenied',
            'onProgressFinished'
        ];
    }
}