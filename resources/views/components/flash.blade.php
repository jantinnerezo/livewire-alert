@if (session()->has('livewire-alert'))
    <script>
        flashAlert(@json(session('livewire-alert')))
    </script>
@endif