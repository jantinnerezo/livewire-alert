<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\SweetAlert2;

enum Response: string
{
    case IsConfirmed = 'isConfirmed';
    case IsDenied = 'isDenied';
    case IsDismissed = 'isDismissed';
}