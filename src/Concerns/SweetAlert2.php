<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Concerns;

use Jantinnerezo\LivewireAlert\Enums\Event;
use Jantinnerezo\LivewireAlert\Exceptions\AlertException;

trait SweetAlert2
{
    /**
     * Triggers a SweetAlert2 alert with the given options and handles specified events.
     *
     * @param array $options The configuration options for the SweetAlert2 alert.
     * @param array $events An associative array of events and their corresponding callbacks.
     * 
     * @throws AlertException If an invalid SweetAlert2 event is provided.
     * 
     * This method generates JavaScript code to display a SweetAlert2 alert with the provided options.
     * It also sets up event listeners for the specified events and calls the corresponding Livewire actions.
     */
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