<?php

namespace Jantinnerezo\LivewireAlert;

use Illuminate\Support\Collection;

trait LivewireAlert
{
    /**
     * Default SweetAlert2 Options.
     *
     * @see https://sweetalert2.github.io/#configuration
     * @return collection $options
     */
    public function alertOptions(): Collection
    {
        return collect([
            'position' =>  'top-end',
            'timer' => 3000,
            'toast' => true,
            'title' =>  '',
            'text' => null,
            'showCancelButton' => false,
            'showConfirmButton' => false
        ]);
    }

    /**
     * Alert an specific message.
     *
     *
     * @param  string  $event - success, info, warning, error
     * @param  string  $message - alert message
     * @param  array  $options - SweetAlert2 options
     * @see https://sweetalert2.github.io/#configuration
     * @return void
     */
    public function alert(
        string $event,
        string $message,
        array $options = []
    ) {
        $this->emit(
            $event,
            $this->alertOptions()
                ->merge($options)
                ->put('title', $message)
                ->toArray()
        );
    }

    /**
     * Alert Success event.
     *
     * @param  array  $options - User-defined SweetAlert2 options
     * @return array  $options
     */
    public function success(array $options)
    {
        return $options;
    }

    /**
     * Alert Warning event.
     *
     * @param  array  $options - User-defined SweetAlert2 options
     * @return array  $options
     */
    public function warning(array $options)
    {
        return $options;
    }

    /**
     * Alert Info event.
     *
     * @param  array  $options - User-defined SweetAlert2 options
     * @return array  $options
     */
    public function info(array $options)
    {
        return $options;
    }

    /**
     * Alert Error event.
     *
     * @param  array  $options - User-defined SweetAlert2 options
     * @return array  $options
     */
    public function error(array $options)
    {
        return $options;
    }
}
