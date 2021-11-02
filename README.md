
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

> SweetAlert2 script is not included by default so make sure you include it before `<x-livewire-alert::scripts />`

``` html
<body> 

  @livewireScripts

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <x-livewire-alert::scripts />
  
</body> 
```


## Requirements
This package uses Livewire under the hood. Please make sure you include it in your dependencies before using this package.

- PHP 7.2 or higher

- Laravel 7 or 8

- Livewire

- SweetAlert2


## Demo

Checkout the playable demo https://livewire-alert.jantinnerezo.com


## Contributors

<a href="https://github.com/jantinnerezo/livewire-alert/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=jantinnerezo/livewire-alert" />
</a>


## :recycle: Changelog


Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## :hammer: Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## :lock: Security

If you discover any security related issues, please email erezojantinn@gmail.com instead of using the issue tracker.

## :label: License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
