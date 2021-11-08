<?php

namespace Jantinnerezo\LivewireAlert\Tests;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TestComponent extends Component
{   
    use LivewireAlert;

    public $status = 'success';

    public $title = 'Hello';

    public $flash = false;

    public $configuration = [];

    public function getListeners()
    {
        return [
            'confirmed',
            'denied',
            'dismissed',
            'progressFinished'
        ];  
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
        $this->confirm('How was your day?', $this->configuration);
    }

    public function confirmed() {}

    public function denied() {}

    public function dismissed() {}

    public function progressFinished() {}

    public function render()
    {
        return <<<'blade'
            <div>
                Hello Word!
            </div>
        blade;
    }
}
