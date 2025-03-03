<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Enums;

enum Position: string
{
    case Top = 'top';
    case TopStart = 'top-start';
    case TopEnd = 'top-end';
    case Center = 'center';
    case CenterStart = 'center-start';
    case CenterEnd = 'center-end';
    case Bottom = 'bottom';
    case BottomStart = 'bottom-start';
    case BottomEnd = 'bottom-end';

    public function is(self $position): bool
    {
        return $this === $position;
    }
}
