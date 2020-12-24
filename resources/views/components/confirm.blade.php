<div
    x-data=""
    @confirming.window="
        window.addEventListener($event.detail, event => {
            const options = {
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: event.detail.options.confirmButtonText ?? 'Yes',
                ...event.detail.options
            };

            Swal.fire(options).then((result) => {
                if (result.isConfirmed) { @this.call(event.detail.onConfirmed); }
                else { const cancelCallback = event.detail.onCancelled; if (!cancelCallback) { return; } @this.call(cancelCallback) }
            })
        });
    "
    wire:ignore
>
    {{ $slot }}
</div>