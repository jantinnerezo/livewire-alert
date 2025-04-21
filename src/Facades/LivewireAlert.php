<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert title(string $title)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert text(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert success()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert error()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert warning()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert info()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert question()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert position(string $position)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert toast(bool $toast = true)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert timer(int $timer)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert html(string | \Closure $value)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withConfirmButton(?string $confirmButtonText = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withCancelButton(?string $cancelButtonText = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withDenyButton(?string $denyButtonText = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert confirmButtonText(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert cancelButtonText(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert denyButtonText(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert confirmButtonColor(string $color)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert cancelButtonColor(string $color)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert denyButtonColor(string $color)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert asConfirm()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert onConfirm(string $action, mixed $data = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert onDeny(string $action, mixed $data = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert onDismiss(string $action, mixed $data = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withOptions(array<string, array<string, string>|string> $options = [])
 *
 * @see \Jantinnerezo\LivewireAlert\LivewireAlert
 */
class LivewireAlert extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewire-alert';
    }
}
