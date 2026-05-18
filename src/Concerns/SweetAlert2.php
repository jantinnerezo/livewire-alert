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

            if (typeof Swal === 'undefined') {
                console.error('[livewire-alert] SweetAlert2 is not loaded. Make sure to include it before using livewire-alert.')
                return
            }

            const alert = await Swal.fire(options)

            if (alert.isConfirmed && {$events}.hasOwnProperty('isConfirmed')) {
                \$wire[{$events}.isConfirmed.action]({
                    ...{$events}.isConfirmed.data || {},
                    value: alert.value
                })
            }

            if (alert.isDenied && {$events}.hasOwnProperty('isDenied')) {
                \$wire[{$events}.isDenied.action]({
                    ...{$events}.isDenied.data || {},
                    value: alert.value
                })
            }

            if (alert.isDismissed && {$events}.hasOwnProperty('isDismissed')) {
                \$wire[{$events}.isDismissed.action]({
                    ...{$events}.isDismissed.data || {},
                    value: alert.value
                })
            }
        JS;

        $this->component->js($js);
    }

    protected function dismiss(): void
    {
        $js = <<<'JS'
            if (typeof Swal === 'undefined') {
                console.error('[livewire-alert] SweetAlert2 is not loaded. Make sure to include it before using livewire-alert.')
                return
            }

            Swal.close()
        JS;

        $this->component->js($js);
    }

    /**
     * @param array<string, mixed> $options
     */
    protected function mutate(array $options): void
    {
        $options = json_encode($options);
        $callbacks = json_encode(Option::callbacks());

        $js = <<<JS
            if (typeof Swal === 'undefined') {
                console.error('[livewire-alert] SweetAlert2 is not loaded. Make sure to include it before using livewire-alert.')
                return
            }

            if (!Swal.isVisible()) {
                console.warn('[livewire-alert] update() called but no alert is open.')
                return
            }

            const options = {$options}

            for (const option in options) {
                if (!{$callbacks}.includes(option)) {
                    continue
                }

                options[option] = eval(options[option])
            }

            Swal.update(options)
        JS;

        $this->component->js($js);
    }
}
