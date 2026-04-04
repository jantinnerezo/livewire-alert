<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Tests;

use Livewire\Component;

class SpyComponent extends Component
{
    public string $lastJs = '';

    public function js(mixed $expression, mixed ...$params): void
    {
        $this->lastJs = $expression;
    }

    public function render(): string
    {
        return '<div></div>';
    }
}
