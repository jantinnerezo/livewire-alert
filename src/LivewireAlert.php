<?php

namespace Jantinnerezo\LivewireAlert;

use Livewire\Component;
class LivewireAlert extends Component
{   
    use WithAlert;

    public $status = 'success';

    public $flash = false;

    public $title = 'Hello!';

    public $responses = [
        'confirmed' => null,
        'denied' => null,
        'dismissed' => null,
        'progressFinished' => null
    ];

    public $configuration = [
        'position'  =>  'top-end',
        'timer'  =>  3000,
        'toast'  =>  true,
        'text' => '',
        'timerProgressBar' => false,
        'showConfirmButton' => false,
        'showDenyButton' => false,
        'showCancelButton' => false,
        'confirmButtonText' => 'Yes',
        'denyButtonText' => 'No',
        'cancelButtonText' => 'Cancel',
        'onConfirmed' => 'confirmed',
        'onDenied' => 'denied',
        'onProgressFinished' => 'progressFinished',
        'onDismissed' => 'dismissed'
    ];

    public function getStatusesProperty()
    {
        return [
            'success' => [
                'text-color' => 'text-green-600',
                'bg-color' => 'bg-green-50',
                'border-color' => 'border-green-600'
            ],
            'info' => [
                'text-color' => 'text-light-blue-600',
                'bg-color' => 'bg-light-blue-50',
                'border-color' => 'border-light-blue-600'
            ],
            'warning' => [
                'text-color' => 'text-yellow-600',
                'bg-color' => 'bg-yellow-50',
                'border-color' => 'border-yellow-600'
            ],
            'error' => [
                'text-color' => 'text-red-600',
                'bg-color' => 'bg-red-50',
                'border-color' => 'border-red-600'
            ]
        ];
    }

    public function getPositionsProperty()
    {
        return [
            'top',
            'top-start',
            'top-end',
            'center',
            'center-start',
            'center-end',
            'bottom',
            'bottom-start',
            'bottom-end'
        ];
    }

    public function getSelectedButtonsProperty()
    {
        $buttons = [];

        if ($this->configuration['showConfirmButton']) {
            $buttons[] = 'Confirm';
        }

        if ($this->configuration['showDenyButton']) {
            $buttons[] = 'Deny';
        }

        if ($this->configuration['showCancelButton']) {
            $buttons[] = 'Cancel';
        }

        return count($buttons) > 0 ? implode(',', $buttons) : 'No buttons';
    }

    public function getListeners()
    {
        return [
            'confirmed',
            'denied',
            'dismissed',
            'progressFinished',
            'testConfirmed'
        ];  
    }

    public function setConfiguration($key, $value)
    {
        $this->configuration[$key] = $value;
    }

    public function showAlert()
    {
        if (! $this->flash) {
            $this->alert(
                $this->status,
                $this->title,
                $this->configuration
            );

            return;
        }

        $this->flash(
            $this->status,
            $this->title,
            $this->configuration
        );
    }

    public function showConfirmAlert()
    {
        $this->confirm('Confirm Alert', [
            'onConfirmed' => 'confirmed'
        ]);
    }

    public function confirmed()
    {
        $this->alert('info', 'On Confirmed Event', [
            'timer' => null,
            'text' => "Fired from livewire onConfirmed event, do what you want here when the user clicks confirm.",
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Got it!',
            'toast' => false
        ]);
    }

    public function denied()
    {
        $this->alert('info', 'On Denied Event', [
            'timer' => null,
            'text' => "Fired from livewire onDenied event, do what you want here when the user clicks deny.",
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Got it!',
            'toast' => false
        ]);
    }

    public function dismissed()
    {
        $this->alert('info', 'On Dismissed Event', [
            'timer' => null,
            'text' => "Fired from livewire onDismissed event, do what you want here when the user dismissed the alert.",
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Got it!',
            'toast' => false
        ]);
    }

    public function progressFinished()
    {
        $this->alert('info', 'On Progress Finished Event', [
            'timer' => null,
            'text' => "Fired from livewire onProgressFinished event. Do what you want here when alert finished loading.",
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Got it!',
            'toast' => false
        ]);
    }

    public function render()
    {
        return view('livewire-alert::livewire.demo');
    }
}
