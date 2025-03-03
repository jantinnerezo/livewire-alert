<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Enums;

enum Icon: string
{
    case Success = 'success';
    case Error = 'error';
    case Warning = 'warning';
    case Info = 'info';
    case Question = 'question';

    public function is(self $icon): bool
    {
        return $this === $icon;
    }
}
