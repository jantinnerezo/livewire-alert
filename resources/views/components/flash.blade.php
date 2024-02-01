@if (session()->has('livewire-alert'))
    <script type="module">
        flashAlert(@json(session('livewire-alert')))
    </script>
@endif