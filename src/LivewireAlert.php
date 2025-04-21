<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert;

use Jantinnerezo\LivewireAlert\Exceptions\InvalidPositionException;
use Livewire\Component;

class LivewireAlert implements Contracts\Alertable
{
    use Concerns\SweetAlert2;

    protected array $options = []; /** @phpstan-ignore missingType.iterableValue */
    protected array $events = []; /** @phpstan-ignore missingType.iterableValue */

    public function __construct(protected ?Component $component)
    {
        throw_if(
            !$this->component instanceof Component,
            new \Exception(
                'LivewireAlert requires a Livewire component context.'
            )
        );
    }

    public function title(string $title): self
    {
        $this->options[Enums\Option::Title->value] = $title;

        return $this;
    }

    public function text(string $text): self
    {
        $this->options[Enums\Option::Text->value] = $text;

        return $this;
    }

    public function success(): self
    {
        $this->options[Enums\Option::Icon->value] = Enums\Icon::Success->value;

        return $this;
    }

    public function error(): self
    {
        $this->options[Enums\Option::Icon->value] = Enums\Icon::Error->value;

        return $this;
    }

    public function warning(): self
    {
        $this->options[Enums\Option::Icon->value] =  Enums\Icon::Warning->value;

        return $this;
    }

    public function info(): self
    {
        $this->options[Enums\Option::Icon->value] = Enums\Icon::Info->value;

        return $this;
    }

    public function question(): self
    {
        $this->options[Enums\Option::Icon->value] = Enums\Icon::Question->value;

        return $this;
    }

    public function position(Enums\Position|string $position): self
    {
        if (is_string($position)) {
            $position = Enums\Position::tryFrom($position);

            throw_if(
                !$position instanceof Enums\Position,
                new InvalidPositionException()
            );
        }

        $this->options[ Enums\Option::Position->value] = $position;

        return $this;
    }

    public function toast(bool $toast = true): self
    {
        $this->options[Enums\Option::Toast->value] = $toast;
        $this->options[Enums\Option::Backdrop->value] = !$toast;

        return $this;
    }

    public function timer(int $timer): self
    {
        $this->options[Enums\Option::Timer->value] = $timer;

        return $this;
    }

    public function html(string | \Closure $value): self
    {
        if ($value instanceof \Closure) {
            $value = $value();

            throw_if(
                !is_string($value),
                new \Exception('The closure must return a string')
            );
        }

        $this->options[Enums\Option::Html->value] = $value;

        return $this;
    }

    public function withConfirmButton(?string $confirmButtonText = null): self
    {
        $this->options[Enums\Option::ShowConfirmButton->value] = true;

        $this->confirmButtonText(
            $confirmButtonText ?? config('livewire-alert.confirmButtonText')
        );

        return $this;
    }

    public function withCancelButton(?string $cancelButtonText = null): self
    {
        $this->options[Enums\Option::ShowCancelButton->value] = true;

        $this->cancelButtonText(
            $cancelButtonText ?? config('livewire-alert.cancelButtonText')
        );

        return $this;
    }

    public function withDenyButton(?string $denyButtonText = null): self
    {
        $this->options[Enums\Option::ShowDenyButton->value] = true;

        $this->denyButtonText(
            $denyButtonText ?? config('livewire-alert.denyButtonText')
        );

        return $this;
    }

    public function confirmButtonText(string $text): self
    {
        $this->options[Enums\Option::ConfirmButtonText->value] = $text;

        return $this;
    }

    public function cancelButtonText(string $text): self
    {
        $this->options[Enums\Option::CancelButtonText->value] = $text;

        return $this;
    }

    public function denyButtonText(string $text): self
    {
        $this->options[Enums\Option::DenyButtonText->value] = $text;

        return $this;
    }

    public function confirmButtonColor(string $color): self
    {
        $this->options[Enums\Option::ConfirmButtonColor->value] = $color;

        return $this;
    }

    public function cancelButtonColor(string $color): self
    {
        $this->options[Enums\Option::CancelButtonColor->value] = $color;

        return $this;
    }

    public function denyButtonColor(string $color): self
    {
        $this->options[Enums\Option::DenyButtonColor->value] = $color;

        return $this;
    }

    public function asConfirm(): self
    {
        $this->question();
        $this->withConfirmButton(config('livewire-alert.confirmButtonText'));
        $this->withDenyButton(config('livewire-alert.denyButtonText'));
        $this->options[Enums\Option::Timer->value] = null;

        return $this;
    }

    public function onConfirm(string $action, mixed $data = null): self
    {
        $this->event(Enums\Event::IsConfirmed, [
            'action' => $action,
            'data' => $data,
        ]);

        return $this;
    }

    public function onDeny(string $action, mixed $data = null): self
    {
        $this->event(Enums\Event::IsDenied, [
            'action' => $action,
            'data' => $data,
        ]);

        return $this;
    }

    public function onDismiss(string $action, mixed $data = null): self
    {
        $this->event(Enums\Event::IsDismissed, [
            'action' => $action,
            'data' => $data,
        ]);

        return $this;
    }

    public function withOptions(array $options = []): self
    {
        $this->options = array_merge(
            $this->options,
            $options
        );

        return $this;
    }

    public function getOptions(): array
    {
        return array_merge(
            config('livewire-alert'),
            array_intersect_key(
                $this->options,
                array_flip(Enums\Option::values())
            ),
        );
    }

    public function getEvents(): array
    {
        return array_intersect_key(
            $this->events,
            array_flip(Enums\Event::values())
        );
    }

    public function show(): void
    {
        $this->alert(
            $this->getOptions(),
            $this->getEvents()
        );
    }

    /**
     * @param array{'action': string, "data": array<array<string, mixed>>} $action
     */
    protected function event(Enums\Event $event, array $action): void
    {
        $this->events[$event->value] = $action;
    }
}
