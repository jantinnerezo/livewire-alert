<?php

namespace Jantinnerezo\LivewireAlert;

use Livewire\Component;
class LivewireAlert extends Component
{   
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
            'progressFinished'
        ];  
    }

    public function setConfiguration($key, $value)
    {
        $this->configuration[$key] = $value;
    }

    public function showAlert()
    {
        if (!$this->flash) {
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

        return redirect()->to('/');
    }

    public function confirmed($data)
    {
        $this->alert('success', 'Confirmed', [
            'text' => "You clicked the {$this->configuration['confirmButtonText']} button",
            'position' => 'center',
            'toast' => false
        ]);
    }

    public function denied($data)
    {
        $this->alert('error', 'Denied', [
            'text' => "You clicked the {$this->configuration['denyButtonText']} button",
            'position' => 'center',
            'toast' => false
        ]);
    }

    public function dismissed($data)
    {
        $this->alert('error', 'Dismissed', [
            'text' => "You clicked the {$this->configuration['denyButtonText']} button",
            'position' => 'center',
            'toast' => false
        ]);
    }

    public function progressFinished($data)
    {
        $this->responses['progressFinished'] = $data;
    }

    public function render()
    {
        return view('livewire-alert::livewire.demo');
    }
}
