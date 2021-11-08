<?php

namespace Jantinnerezo\LivewireAlert\Exceptions;

use Exception;

class AlertException extends Exception
{
    protected $message;
    
    public function __construct($message)
    {
        $this->message = $message;

        parent::__construct();
    }

    public function __toString() {
        return "Livewire Alert Exception: {$this->message}";
    }
}
