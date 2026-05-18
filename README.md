
# Livewire Alert

<a href="https://github.com/jantinnerezo/livewire-alert/actions"><img src="https://github.com/jantinnerezo/livewire-alert/workflows/PHPUnit/badge.svg" alt="Build Status"></a> [![PHPStan Analysis](https://github.com/jantinnerezo/livewire-alert/workflows/PHPStan/badge.svg)](https://github.com/jantinnerezo/livewire-alert/actions) <a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/dt/jantinnerezo/livewire-alert" alt="Total Downloads"></a> <a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/l/jantinnerezo/livewire-alert" alt="License"></a>

Livewire Alert is a Laravel Livewire package that brings SweetAlert2 notifications to your Livewire components through a fluent, chainable API. Configure and trigger beautiful, interactive alerts with a clean PHP interface — no JavaScript required.

## 📖 Documentation

Full documentation, live examples, and an interactive playground are hosted at:

### 👉 [https://livewire-alert.jantinnerezo.me](https://livewire-alert.jantinnerezo.me)

Every feature — icons, positions, toasts, timers, buttons, confirm dialogs, loading alerts, in-place updates, inputs, flash alerts, images, custom classes, dependency injection and more — is documented there with copy-pasteable snippets and runnable demos.

## Requirements
- PHP 8.1 or higher
- Laravel 10.x or higher
- Livewire 3.x or 4.x
- Composer

## Installation

Require the package with Composer:

``` bash
composer require jantinnerezo/livewire-alert
```

Optionally publish the config file:

``` bash
php artisan vendor:publish --tag=livewire-alert:config
```

Install SweetAlert2 via npm or yarn:

``` bash
npm install sweetalert2
```

``` bash
yarn add sweetalert2
```

Then import it in `resources/js/app.js`:

``` js
import Swal from 'sweetalert2'

window.Swal = Swal
```

Or include it via CDN before the closing `</body>` tag:

``` html
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
```

### Filament

Register SweetAlert2 as a Filament asset in your `AppServiceProvider`:

``` php
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Vite;
use Filament\Support\Assets\Js;

public function boot()
{
    FilamentAsset::register([
        Js::make('sweetalert2', Vite::asset('resources/js/sweetalert2.js')),
        // Or via CDN:
        // Js::make('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11'),
    ]);
}
```

## Quick taste

``` php
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

public function save()
{
    LivewireAlert::title('Changes saved!')
        ->success()
        ->show();
}
```

For everything else — head to the [documentation site](https://livewire-alert.jantinnerezo.me).

## Looking for v3?

The last v3 release was [v3.0.3](https://github.com/jantinnerezo/livewire-alert/releases/tag/v3.0.3) (March 11, 2024). v4 is a major refactor introducing the fluent Facade API, dependency injection, and many more features. For v3:

``` bash
composer require jantinnerezo/livewire-alert:^3.0
```

Upgrading to v4 is recommended for new and ongoing projects.

## Testing

``` bash
composer test
```

## Contributors

<a href="https://github.com/jantinnerezo/livewire-alert/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=jantinnerezo/livewire-alert" width="300" />
</a>

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email erezojantinn@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
