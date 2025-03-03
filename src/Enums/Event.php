<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Enums;

enum Event: string
{
    case IsConfirmed = 'isConfirmed';
    case IsDenied = 'isDenied';
    case IsDismissed = 'isDismissed';

    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return array_map(
            fn (self $event) => $event->value,
            self::cases()
        );
    }
}
