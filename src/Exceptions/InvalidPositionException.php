<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Exceptions;

use Exception;

class InvalidPositionException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            "Invalid position value. see:  Jantinnerezo\LivewireAlert\Enums\Position for available values."
        );
    }
}
