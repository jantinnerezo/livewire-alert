
# Livewire Alert
[![Latest Stable Version](https://poser.pugx.org/jantinnerezo/livewire-alert/v)](//packagist.org/packages/jantinnerezo/livewire-alert)
[![Total Downloads](https://poser.pugx.org/jantinnerezo/livewire-alert/downloads)](//packagist.org/packages/jantinnerezo/livewire-alert)
[![License](https://poser.pugx.org/jantinnerezo/livewire-alert/license)](//packagist.org/packages/jantinnerezo/livewire-alert)

This package provides a simple alert utilities for your livewire components. Currently using [SweetAlert2](https://www.example.com) under-the-hood.
You can now use your favorite SweetAlert2 without writing any custom Javascript. Looking forward to integrate other Javascript alert libraries, feel free to contribute or suggest any libraries.


## Installation

You can install the package via composer:

```bash

composer require jantinnerezo/livewire-alert

```

Next, add the scripts component to your template after the `@livewireScripts`.

> SweetAlert2 script is not included by default so make sure you include it before livewire alert script.

``` html
<body> 

  @livewireScripts

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <x-livewire-alert::scripts />
  
</body> 
```

You can also manually include the script by publishing `livewire-alert.js`

``` bash
php artisan vendor:publish --tag=livewire-alert:assets
```

And then in your view you can include the published script instead of including inline script with `<x-livewire-alert::scripts />` component.
``` html
<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script> 
```

## Requirements
This package is meant to use with Livewire components. Make sure you are using it with Livewire projects only.

- PHP 7.2 or higher

- Laravel 7 or 8

- Livewire

- SweetAlert2


## Demo

Checkout the playable demo https://livewire-alert.jantinnerezo.com

## Usage

You can use livewire alert by using the `WithAlert` trait.

The first parameter is the icon of the alert: `success`, `info`, `warning`, `question` and `error`. The second parameter is the alert title and the third one is for extra configuration.

``` php
use Jantinnerezo\LivewireAlert\WithAlert;
 
class Index extends Component
{
    use WithAlert;
    
    public function submit()
    {
        $this->alert('success', 'Basic Alert');
    }
}
```

Displaying different alert icons. 
> The default alert behaviour is a toast notification.

``` php
$this->alert('success', 'Success is approaching!');
```

``` php
$this->alert('warning', 'The world has warned you.');
```

``` php
$this->alert('info', 'The fact is you know your name :D');
```

``` php
$this->alert('question', 'How are you today?');
```

Disabling toast notification alert treatment.


``` php
$this->alert('info', 'This is not as toast alert', [
    'toast' => false
]);
```

## Positioning Alert

``` php
$this->alert('info', 'Centering alert', [
    'position' => 'center'
]);
```

List of the following alert positions:
- top
- top-start
- top-end
- center
- center-start
- center-end
- bottom
- bottom-start
- bottom-end

## Configuration

Passing additional configuration.


## Contributors

<a href="https://github.com/jantinnerezo/livewire-alert/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=jantinnerezo/livewire-alert" />
</a>


## Changelog


Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## :hammer: Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## :lock: Security

If you discover any security related issues, please email erezojantinn@gmail.com instead of using the issue tracker.

## :label: License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
