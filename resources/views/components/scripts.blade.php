<script>
// Handles showing alert
window.addEventListener('alert',event=>{const type=event.detail.type ?? null;const options={position:'top-end',timer:3000,toast:true,title:event.detail.message ?? '',text:null,showCancelButton:false,showConfirmButton:false,...event.detail.options};Swal.fire({...options,icon:type})});

// Handles alert confirmation
window.addEventListener('confirming', confirming => {
    window.addEventListener(confirming.detail, event => {
        const options = {
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event.detail.options.confirmButtonText ?? 'Yes',
            ...event.detail.options
        };
        Swal.fire(options).then((result) => {
            if (result.isConfirmed) { Livewire.emit(event.detail.onConfirmed); }
            else { const cancelCallback = event.detail.onCancelled; if (!cancelCallback) { return; } Livewire.emit(cancelCallback) }
        })
    });
});
</script>

<!-- Responsible for showing flash messages alert -->
@if (session()->has('livewire-alert'))
    <script>
        const flash=@json(session('livewire-alert'));const type=flash.type??null;const options={position:'top-end',timer:3000,toast:!0,title:flash.message??'',text:null,showCancelButton:!1,showConfirmButton:!1,...flash.options};Swal.fire({...options,icon:type})
    </script>
@endif