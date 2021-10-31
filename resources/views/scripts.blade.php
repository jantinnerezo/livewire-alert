<script>
    /**** Livewire Alert Scripts ****/
    {!! file_get_contents($jsPath) !!}
</script>

@if (session()->has('livewire-alert'))
    <script>
        "use strict";

        window.onload = function (event) {
            var _flash$message, _flash$type;

            var flash = @json(session('livewire-alert'));

            Swal.fire(_objectSpread({
                title: (_flash$message = flash.message) !== null && _flash$message !== void 0 ? _flash$message : '',
                icon: (_flash$type = flash.type) !== null && _flash$type !== void 0 ? _flash$type : null
            }, flash.options));
        };
    </script>
@endif