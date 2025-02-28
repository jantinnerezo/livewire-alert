<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Concerns;

use Jantinnerezo\LivewireAlert\Enums\Event;
use Jantinnerezo\LivewireAlert\Exceptions\AlertException;

trait SweetAlert2
{
    protected function alert(array $options, array $events = []): void
    {
        $js = 'const alert = await Swal.fire(' . json_encode($options) . ');';

        foreach ($events as $event => $callback) {
            throw_if(
                !Event::tryFrom($event) instanceof Event,
                new AlertException("Invalid callback for SweetAlert2 Event: {$event}")
            );

            $js .= ' if (alert.' . $event . ') { ';

            $js .= "\$wire.call('{$callback['action']}', { ..." . json_encode($callback['data']) . ", value: alert.value });";

            $js .= ' }';
        }

        $this->component->js($js);
    }
}