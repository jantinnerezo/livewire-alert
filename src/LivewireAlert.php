<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert;

use Livewire\Component;

class LivewireAlert
{
    use Concerns\SweetAlert2;

    protected array $options = [];
    protected array $events = [];

    public function __construct(protected ?Component $component)
    {
        $this->component = $component ?? \Livewire\Livewire::getInstance();

        throw_if(
            !$this->component,
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
        $this->options[
            Enums\Option::Position->value
        ] = $position instanceof Enums\Position ? $position->value : $position;

        return $this;
    }

    public function toast(): self
    {
        $this->options[Enums\Option::Toast->value] = true;

        return $this;
    }

    public function timer(int $timer): self
    {
        $this->options[Enums\Option::Timer->value] = $timer;

        return $this;
    }

    public function showConfirmButton(): self
    {
        $this->options[Enums\Option::ShowConfirmButton->value] = true;

        return $this;
    }

    public function showCancelButton(): self
    {
        $this->options[Enums\Option::ShowCancelButton->value] = true;

        return $this;
    }

    public function showDenyButton(): self
    {
        $this->options[Enums\Option::ShowDenyButton->value] = true;

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

    public function asConfirmation(): self
    {
        $this->question();
        $this->showConfirmButton();
        $this->showDenyButton();
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

    public function options(array $options = []): self
    {
        $this->options = array_merge(
            $this->options, 
            $options
        );

        return $this;
    }

    public function show(): void
    {
        $this->alert(
            array_merge(
                config('livewire-alert'),
                array_intersect_key(
                    $this->options, array_flip(Enums\Option::values())
                ),
            ),
            $this->events
        );
    }

    protected function event(Enums\Event $event, array $action): void
    {
        $this->events[$event->value] = $action;
    }
}
