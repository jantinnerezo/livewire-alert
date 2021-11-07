const mix = require('laravel-mix');

mix.js(
    'resources/js/livewire-alert.js', 
    'public'
)
.setPublicPath('public')
.version();