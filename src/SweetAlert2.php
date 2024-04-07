<?php

namespace Jantinnerezo\LivewireAlert;

use Jantinnerezo\LivewireAlert\SweetAlert2\Response;
use Jantinnerezo\LivewireAlert\SweetAlert2\Option;
use Jantinnerezo\LivewireAlert\Exceptions\AlertException;

trait SweetAlert2
{
    public function confirm(string $title, array $options = [], array $events = []): void
    {
        $options =  [
            ...$options,
            ...config('livewire-alert.confirm'),
        ];
        
        $this->alert($title, $options, $events);
    }

    public function alert(string $title, array $options = [], array $events = []): void
    {
        data_set($options, 'title', $title);

        $options = [
            ...config('livewire-alert.alert') ?? [],
            ...config('livewire-alert.' . data_get($options, 'icon')) ?? [],
            ...array_intersect_key($options, array_flip(Option::values()))
        ];

        $javascriptString = 'const alert = await Swal.fire(' . json_encode($options) . ');';

        if ($events) {
            foreach ($events as $event => $callback) {
                if (is_null(Response::tryFrom($event))) {
                    throw new AlertException("Invalid SweetAlert2 Event: {$event}");
                }
                
                $javascriptString .= ' if (alert.'. $event . ')';

                if (is_array($callback)) {
                    $javascriptString .= "\$wire.call( '{$callback['method']}', " . json_encode($callback['params']) . ");";

                    continue;
                }

                $javascriptString .= " \$wire.call('{$callback}', alert.value);";
            }
        }

        $this->js($javascriptString);
    }
}