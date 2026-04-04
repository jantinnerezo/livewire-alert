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
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert timer(int|null $timer)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert html(string | \Closure $value)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert allowOutsideClick(bool | \Closure $allowed = true)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert allowEscapeKey(bool | \Closure $allowed = true)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withConfirmButton(?string $confirmButtonText = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withCancelButton(?string $cancelButtonText = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withDenyButton(?string $denyButtonText = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert confirmButtonText(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert cancelButtonText(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert denyButtonText(string $text)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert confirmButtonColor(string $color)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert cancelButtonColor(string $color)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert denyButtonColor(string $color)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert imageUrl(string $url)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert imageWidth(int $width)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert imageHeight(int $height)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert imageAlt(string $alt)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert timerProgressBar(bool $show = true)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert asConfirm()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert asToast()
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert customClass(array<string, string> $classes)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert reverseButtons(bool $reverse = true)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withTextInput(?string $label = null, ?string $placeholder = null, ?string $value = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withEmailInput(?string $label = null, ?string $placeholder = null, ?string $value = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withPasswordInput(?string $label = null, ?string $placeholder = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withNumberInput(?string $label = null, ?string $placeholder = null, ?string $value = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withTextareaInput(?string $label = null, ?string $placeholder = null, ?string $value = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withSelectInput(array<string, string> $options = [], ?string $label = null, ?string $value = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withRadioInput(array<string, string> $options = [], ?string $label = null, ?string $value = null)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withCheckboxInput(?string $label = null, bool $checked = false)
 * @method static \Jantinnerezo\LivewireAlert\LivewireAlert withFileInput(?string $label = null)
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
