
# Livewire Alert

<a href="https://github.com/jantinnerezo/livewire-alert/actions"><img src="https://github.com/jantinnerezo/livewire-alert/workflows/PHPUnit/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/v/jantinnerezo/livewire-alert" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/dt/jantinnerezo/livewire-alert" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/l/jantinnerezo/livewire-alert" alt="License"></a>

Livewire Alert is a Laravel package designed to integrate sweetalert-style notifications seamlessly into Laravel Livewire applications. This package simplifies the process of displaying beautiful, customizable alerts to users, enhancing the interactivity and user experience of your Livewire projects.

## Features
- Easy integration with Laravel Livewire
- Customizable SweetAlert2-based alerts
- Support for various alert types (success, error, warning, info, etc.)
- Configurable options for alert styling and behavior
- Lightweight and dependency-efficient

## Requirements
- PHP 8.1 or higher
- Laravel 10.x or higher
- Livewire 3.x
- Composer

## Installation
``` bash
composer require jantinnerezo/livewire-alert
```

## Usage
The LivewireAlert package provides a convenient Facade that allows you to trigger customizable SweetAlert2-based alerts in your Laravel Livewire application. The Facade uses a fluent interface, enabling you to chain methods to configure your alert before displaying it.

### Basic Usage

``` php
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

public function save()
{
    LivewireAlert::title('Changes saved!')->success()->show();
}
```

### Adding text

``` php
LivewireAlert::title('Item Saved')
  ->text('The item has been successfully saved to the database.')
  ->success()
  ->show();
```

### Available alert icons

``` php
LivewireAlert::title('Success')->success();
```
``` php
LivewireAlert::title('Error')->error();
```
``` php
LivewireAlert::title('Warning')->warning();
```
``` php
LivewireAlert::title('Info')->info();
```
``` php
LivewireAlert::title('Question')->question();
```

### Position
``` php
use Jantinnerezo\LivewireAlert\Enums\Position;

LivewireAlert::title('Question')->position(Position:);
```
