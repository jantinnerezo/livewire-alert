<script>
    "use strict";

    window.addEventListener('alert', event => {
        var _event$detail$message, _event$detail$type;

        Swal.fire(Object.assign({}, {
            title: (_event$detail$message = event.detail.message) !== null && _event$detail$message !== void 0 ? _event$detail$message : '',
            icon: (_event$detail$type = event.detail.type) !== null && _event$detail$type !== void 0 ? _event$detail$type : null,
        }, event.detail.options));
    });
    window.addEventListener('confirming', confirming => {
        window.addEventListener(confirming.detail, event => {
            var _event$detail$options;

            Swal.fire(Object.assign(
                {}, {
                    confirmButtonText: (_event$detail$options = event.detail.options.confirmButtonText) !== null && _event$detail$options !== void 0 ? _event$detail$options : 'Yes',
                }, event.detail.options
            )).then(result => {
                if (result.isConfirmed) {
                    Livewire.emit(event.detail.onConfirmed, event.detail.options["inputAttributes"]);
                } else {
                    const cancelCallback = event.detail.onCancelled;

                    if (!cancelCallback) {
                        return;
                    }

                    Livewire.emit(cancelCallback);
                }
            });
        });
    });
</script>

@if (session()->has('livewire-alert'))
    <script>
        "use strict";

        window.onload = event => {
            var _flash$message, _flash$type;

            const flash = @json(session('livewire-alert'));
            Swal.fire({
                title: (_flash$message = flash.message) !== null && _flash$message !== void 0 ? _flash$message : '',
                icon: (_flash$type = flash.type) !== null && _flash$type !== void 0 ? _flash$type : null,
                ...flash.options
            });
        };
    </script>
@endif
