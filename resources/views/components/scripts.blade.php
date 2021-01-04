<script>

window.addEventListener('alert', event => {
    Swal.fire({
        title: event.detail.message ?? '',
        icon: event.detail.type ?? null,
        ...event.detail.options
    })
});

window.addEventListener('confirming', confirming => {
    window.addEventListener(confirming.detail, event => {
        Swal.fire({
            confirmButtonText: event.detail.options.confirmButtonText ?? 'Yes',
            ...event.detail.options
        }).then((result) => {
            if (result.isConfirmed) { Livewire.emit(event.detail.onConfirmed); }
            else { const cancelCallback = event.detail.onCancelled; if (!cancelCallback) { return; } Livewire.emit(cancelCallback) }
        })
    });
});
</script>

@if (session()->has('livewire-alert'))
    <script>
        const flash = @json(session('livewire-alert'));
        Swal.fire({
            title: flash.message ?? '',
            icon: flash.type ?? null,
            ...flash.options
        })
    </script>
@endif