<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Concerns;

use Jantinnerezo\LivewireAlert\Enums\Option;

trait SweetAlert2
{
    /**
     * @param array<\Jantinnerezo\LivewireAlert\Enums\Option, array<string, mixed>> $options
     * @param array<\Jantinnerezo\LivewireAlert\Enums\Event, array<string, mixed>> $events
     */
    protected function alert(array $options, array $events = []): void
    {
        $options = json_encode($options);
        $events = json_encode($events);
        $callbacks = json_encode(Option::callbacks());

        $js = <<<JS
            const options = {$options}

            // Evaluate callback functions
            for (const option in options) {
                if (!{$callbacks}.includes(option)) {
                    continue
                }

                options[option] = eval(options[option])
            }

            const alert = await Swal.fire(options)

            if (alert.isConfirmed && {$events}.hasOwnProperty('isConfirmed')) {
                \$wire.call({$events}.isConfirmed.action, {
                    ...{$events}.isConfirmed.data || {},
                    value: alert.value
                })
            }
            
            if (alert.isDenied && {$events}.hasOwnProperty('isDenied')) {
                \$wire.call({$events}.isDenied.action, {
                    ...{$events}.isDenied.data || {},
                    value: alert.value
                })
            }

            if (alert.isDismissed && {$events}.hasOwnProperty('isDismissed')) {
                \$wire.call({$events}.isDismissed.action, {
                    ...{$events}.isDismissed.data || {},
                    value: alert.value
                })
            }
        JS;

        $this->component->js($js);
    }
}
