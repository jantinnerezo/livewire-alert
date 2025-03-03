
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
The `position()` method allows you to specify where the alert appears on the screen. You can use either the Position enum for type safety or a plain string for flexibility.

#### Using the Position Enum
Leverage the Position enum for predefined, type-safe options:

``` php
use Jantinnerezo\LivewireAlert\Enums\Position;

LivewireAlert::title('Question')
    ->position(Position::Center)
    ->question()
    ->show();
```

#### Using a String Value
Alternatively, pass a string directly, but it must exactly match one of the `Position` enum values:

``` php
LivewireAlert::title('Question')
    ->position('center')
    ->question()
    ->show();
```
See: [Position enum](https://github.com/jantinnerezo/livewire-alert/blob/v4/src/Enums/Position.php).

### Toast Notification
Create a toast-style alert with the toast() method:

``` php
LivewireAlert::title('Welcome!')
    ->text('You have logged in successfully.')
    ->info()
    ->toast()
    ->position('top-end')
    ->show();
```

### Timer
The `timer()` method sets an auto-dismiss timer for the alert, specifying how long (in milliseconds) the alert remains visible before closing automatically.

#### Usage
Pass an integer representing the duration in milliseconds:

``` php
LivewireAlert::title('Success')
    ->text('Operation completed successfully.')
    ->success()
    ->timer(3000) // Dismisses after 3 seconds
    ->show();
```

### Buttons

The LivewireAlert package provides methods to add and customize buttons in your alerts: `withConfirmButton()`, `withCancelButton()`, and `withDenyButton()`. Each button can trigger specific events, handled via `onConfirm()`, `onDeny()`, or `onDismiss()`, allowing you to execute custom logic in your Livewire component.

#### Confirm
``` php
LivewireAlert::title('Save?')
    ->withConfirmButton('Yes, Save')
    ->show();
```

#### Cancel
``` php
LivewireAlert::title('Hey cancel')
    ->withCancelButton('Cancel')
    ->show();
```

#### Deny
``` php
LivewireAlert::title('Are you do you want to do it?')
    ->withDenyButton('No')
    ->show();
```

### Button Events

Each button can trigger a corresponding event when clicked, allowing you to handle user interactions in your Livewire component.

#### `onConfirm()`

``` php
LivewireAlert::title('Save?')
    ->withConfirmButton('Save')
    ->onConfirm('saveData', ['id' => $this->itemId])
    ->show();

public function saveData($data)
{
    $itemId = $data['id'];
    // Save logic
}
```

#### `onDismiss()`

``` php
LivewireAlert::title('Delete?')
    ->withConfirmButton('Delete')
    ->withCancelButton('Keep')
    ->onDismiss('cancelDelete', ['id' => $this->itemId])
    ->show();

public function cancelDelete($data)
{
    $itemId = $data['id'];
    // Cancel logic
}
```

#### `onDismiss()`

``` php
LivewireAlert::title('Update?')
    ->withConfirmButton('Update')
    ->withDenyButton('Discard')
    ->onDeny('discardChanges', ['id' => $this->itemId])
    ->show();

public function discardChanges($data)
{
    $itemId = $data['id'];
    // Discard logic
}
```

#### Using them together example

``` php
LivewireAlert::title('Process File')
    ->text('What would you like to do?')
    ->question()
    ->withConfirmButton('Save')
    ->withCancelButton('Cancel')
    ->withDenyButton('Delete')
    ->onConfirm('saveFile', ['id' => $this->fileId])
    ->onDeny('deleteFile', ['id' => $this->fileId])
    ->onDismiss('cancelAction', ['id' => $this->fileId])
    ->show();
```
