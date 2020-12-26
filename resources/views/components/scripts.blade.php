<script>
// Handles showing alert
window.addEventListener('alert', event => {
    Swal.fire({
        position: 'top-end',
        timer: 3000,
        toast: true,
        title: event.detail.message ?? '',
        text: null,
        showCancelButton: false,
        showConfirmButton: false,
        icon: event.detail.type ?? null,
        ...event.detail.options
    })
});

// Handles alert confirmation
window.addEventListener('confirming', confirming => {
    window.addEventListener(confirming.detail, event => {
        Swal.fire({
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event.detail.options.confirmButtonText ?? 'Yes',
            ...event.detail.options
        }).then((result) => {
            if (result.isConfirmed) { Livewire.emit(event.detail.onConfirmed); }
            else { const cancelCallback = event.detail.onCancelled; if (!cancelCallback) { return; } Livewire.emit(cancelCallback) }
        })
    });
});
</script>

<!-- Only fire SweetAlert2 when livewire-alert is present in the session -->
@if (session()->has('livewire-alert'))
    <script>
        const flash = @json(session('livewire-alert'));
        Swal.fire({
            position: 'top-end',
            timer: 3000,
            toast: !0,
            title: flash.message ?? '',
            text: null,
            showCancelButton: !1,
            showConfirmButton: !1,
            icon: flash.type ?? null,
            ...flash.options
        })
    </script>
@endif