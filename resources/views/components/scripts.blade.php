<script>
    /**** Livewire Alert Scripts ****/
    {!! file_get_contents($jsPath) !!}
</script>

@if (session()->has('livewire-alert'))
    <script> 
        window.onload = event => {
            flashAlert(
                @json(session('livewire-alert'))
            ) 
        }
    </script>
@endif