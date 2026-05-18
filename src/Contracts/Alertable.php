<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Contracts;

use Jantinnerezo\LivewireAlert\Enums\Position;

interface Alertable
{
    public function title(string $title): self;

    public function text(string $text): self;

    public function success(): self;

    public function error(): self;

    public function warning(): self;

    public function info(): self;

    public function question(): self;

    public function position(Position|string $position): self;

    public function toast(bool $toast = true): self;

    public function timer(int|null $timer): self;

    public function html(string | \Closure $value): self;

    public function allowOutsideClick(bool | \Closure $allowed = true): self;

    public function allowEscapeKey(bool | \Closure $allowed = true): self;

    public function withConfirmButton(?string $text): self;

    public function withCancelButton(?string $text): self;

    public function withDenyButton(?string $text): self;

    public function confirmButtonText(string $text): self;

    public function cancelButtonText(string $text): self;

    public function denyButtonText(string $text): self;

    public function confirmButtonColor(string $color): self;

    public function cancelButtonColor(string $color): self;

    public function denyButtonColor(string $color): self;

    public function imageUrl(string $url): self;

    public function imageWidth(int $width): self;

    public function imageHeight(int $height): self;

    public function imageAlt(string $alt): self;

    public function timerProgressBar(bool $show = true): self;

    public function asConfirm(): self;

    public function asToast(): self;

    public function asLoading(?string $title = null): self;

    /** @param array<string, string> $classes */
    public function customClass(array $classes): self;

    public function reverseButtons(bool $reverse = true): self;

    public function withTextInput(?string $label = null, ?string $placeholder = null, ?string $value = null): self;

    public function withEmailInput(?string $label = null, ?string $placeholder = null, ?string $value = null): self;

    public function withPasswordInput(?string $label = null, ?string $placeholder = null): self;

    public function withNumberInput(?string $label = null, ?string $placeholder = null, ?string $value = null): self;

    public function withTextareaInput(?string $label = null, ?string $placeholder = null, ?string $value = null): self;

    /** @param array<string, string> $options */
    public function withSelectInput(array $options = [], ?string $label = null, ?string $value = null): self;

    /** @param array<string, string> $options */
    public function withRadioInput(array $options = [], ?string $label = null, ?string $value = null): self;

    public function withCheckboxInput(?string $label = null, bool $checked = false): self;

    public function withFileInput(?string $label = null): self;

    /**
     * @param string $action
     * @param array<mixed> $data
     */
    public function onConfirm(string $action, array $data = []): self;

    /**
    * @param string $action
    * @param array<mixed> $data
    */
    public function onDeny(string $action, array $data = []): self;

    /**
     * @param string $action
     * @param array<mixed> $data
     */
    public function onDismiss(string $action, array $data = []): self;

    /**
    * @param array<\Jantinnerezo\LivewireAlert\Enums\Option, mixed> $options
    */
    public function withOptions(array $options = []): self;

    /**
     * @return array<\Jantinnerezo\LivewireAlert\Enums\Option, mixed>
     */
    public function getOptions(): array;

    /**
     * @return array<\Jantinnerezo\LivewireAlert\Enums\Event, mixed>
     */
    public function getEvents(): array;

    public function show(): void;

    public function close(): void;

    /**
     * @param array<string, mixed>|null $options
     */
    public function update(?array $options = null): void;
}
