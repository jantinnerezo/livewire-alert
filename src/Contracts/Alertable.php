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

    public function timer(int $timer): self;

    public function html(string | \Closure $value): self;

    public function withConfirmButton(?string $text): self;

    public function withCancelButton(?string $text): self;

    public function withDenyButton(?string $text): self;

    public function confirmButtonText(string $text): self;

    public function cancelButtonText(string $text): self;

    public function denyButtonText(string $text): self;

    public function confirmButtonColor(string $color): self;

    public function cancelButtonColor(string $color): self;

    public function denyButtonColor(string $color): self;

    public function asConfirm(): self;

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
}
