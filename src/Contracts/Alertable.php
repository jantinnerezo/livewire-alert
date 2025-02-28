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

    public function onConfirm(string $action, array $data = []): self;

    public function onDeny(string $action, array $data = []): self;

    public function onDismiss(string $action, array $data = []): self;
    
    public function options(array $options = []): self;

    public function getOptions(): array;

    public function getEvents(): array;

    public function show(): void;
}
