
# Livewire Alert

<a href="https://github.com/jantinnerezo/livewire-alert/actions"><img src="https://github.com/jantinnerezo/livewire-alert/workflows/PHPUnit/badge.svg" alt="Build Status"></a> [![PHPStan Analysis](https://github.com/jantinnerezo/livewire-alert/workflows/PHPStan/badge.svg)](https://github.com/jantinnerezo/livewire-alert/actions) <a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/dt/jantinnerezo/livewire-alert" alt="Total Downloads"></a> <a href="https://packagist.org/packages/jantinnerezo/livewire-alert"><img src="https://img.shields.io/packagist/l/jantinnerezo/livewire-alert" alt="License"></a>

Livewire Alert is a Laravel Livewire package designed to integrate SweetAlert2 notifications seamlessly into Livewire projects. This package simplifies the process of displaying simple, customizable alerts to users, enhancing the interactivity and user experience of your Livewire projects.

You can check the interactive demo here: [livewire-alert.laravel.cloud](https://livewire-alert.laravel.cloud)

## Requirements
- PHP 8.1 or higher
- Laravel 10.x or higher
- Livewire 3.x
- Composer

## Installation

First, require the package with Composer:

``` bash
composer require jantinnerezo/livewire-alert
```

Optionally, if you want to customize the global configuration, you can publish the config file:

``` bash
php artisan vendor:publish --tag=livewire-alert:config
```

Next, install SweetAlert2 via npm or yan:

NPM 
``` bash
npm install sweetalert2
```

Yarn 
``` bash
yarn add sweetalert2
```

After installing SweetAlert2, import it into your `resources/js/app.js` file

``` js
import Swal from 'sweetalert2'

window.Swal = Swal
```

If you prefer not to use package manager installation, you can include SweetAlert2 directly via CDN. Add the following script to your Blade layout file `(e.g., resources/views/layouts/app.blade.php)` before the closing `</body>` tag:

``` html
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
```

## Filament

Integrate Livewire Alert in your Filament project, simply register the JavaScript asset in the boot method of your `AppServiceProvider` to import SweetAlert2.

``` php
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Vite;
use Filament\Support\Assets\Js;

public function boot()
{
    FilamentAsset::register([
        // Local asset build using Vite
        Js::make('sweetalert2', Vite::asset('resources/js/sweetalert2.js')),

        // Or via CDN
        Js::make('sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11'),
    ]);
}
```


## Usage
This package provides a convenient Facade that allows you to trigger customizable SweetAlert2-based alerts in your Laravel Livewire application. The Facade uses a fluent interface, enabling you to chain methods to configure your alert before displaying it.

### Basic Usage

``` php
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

public function save()
{
    LivewireAlert::title('Changes saved!')
        ->success()
        ->show();
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
Alternatively, you can pass a string directly, but it must exactly match one of the `Position` enum values, See: [Position](https://github.com/jantinnerezo/livewire-alert/blob/v4/src/Enums/Position.php) enum.

``` php
LivewireAlert::title('Question')
    ->position('center')
    ->question()
    ->show();
```

### Toast Notification
Create a toast-style alert with the `toast()` method:

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

### Button text

Alternatively, you can use `confirmButtonText()`, `cancelButtonText()`, and `denyButtonText()` to set the text after enabling the buttons with `withConfirmButton()`, `withCancelButton()`, or `withDenyButton()` without text:

``` php
LivewireAlert::title('Save?')
    ->withConfirmButton() // Enables button with default text
    ->confirmButtonText('Yes')
    ->withDenyButton()    // Enables button with default text
    ->denyButtonText('No')
    ->withCancelButton()  // Enables button with default text
    ->cancelButtonText('Cancel')
    ->show();
```

### Button Color
You can customize the appearance of buttons by setting their colors using the `confirmButtonColor()`, `cancelButtonColor()`, and `denyButtonColor()` methods. These methods accept a color value (e.g., color names, hex codes, or CSS-compatible strings) to style the respective buttons.

``` php
LivewireAlert::title('Save?')
    ->confirmButtonColor('green')
    ->withDenyButton('red')
    ->withCancelButton('blue')
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

#### `onDeny()`

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

### Confirm Dialog

The `asConfirm()` method configures the alert as a confirmation dialog with a predefined options. It automatically applies a question icon, adds confirm and deny buttons with default text from the configuration, and disables the auto-dismiss timer, making it ideal for scenarios requiring explicit user input.

``` php
LivewireAlert::title('Are you sure?')
    ->text('Do you want to proceed with this action?')
    ->asConfirm()
    ->show();
```

#### Handling Events

Combine with `onConfirm()` and `onDeny()` to handle user responses:

``` php
LivewireAlert::title('Delete Item')
    ->text('Are you sure you want to delete this item?')
    ->asConfirm()
    ->onConfirm('deleteItem', ['id' => $this->itemId])
    ->onDeny('keepItem', ['id' => $this->itemId])
    ->show();

public function deleteItem($data)
{
    $itemId = $data['id'];
    // Delete logic
}

public function keepItem($data)
{
    $itemId = $data['id'];
    // Keep logic
}
```

### Inputs

The LivewireAlert package allows you to add input fields to alerts using the `withOptions()` method, leveraging SweetAlert2’s input capabilities. This is useful for collecting user input (e.g., text, selections) directly within the alert, with the input value returned via event handlers like `onConfirm()`.

#### Usage
Use `withOptions()` to pass an array containing SweetAlert2 input options. Common input types include `text`, `email`, `password`, `number`, `textarea`, `select`, `radio`, `checkbox`, and `file`.

Add a simple text input:

``` php
LivewireAlert::title('Enter Your Name')
    ->withOptions([
        'input' => 'text',
        'inputPlaceholder' => 'Your name here',
    ])
    ->withConfirmButton('Submit')
    ->onConfirm('saveName')
    ->show();

public function saveName($data)
{
    $name = $data['value']; // User’s input from the text field
    // Save the name
}
```

Select Input Example

``` php
LivewireAlert::title('Choose an Option')
    ->withOptions([
        'input' => 'select',
        'inputOptions' => [
            'small' => 'Small',
            'medium' => 'Medium',
            'large' => 'Large',
        ],
        'inputPlaceholder' => 'Select a size',
    ])
    ->withConfirmButton('Confirm')
    ->onConfirm('processSelection')
    ->show();

public function processSelection($data)
{
    $size = $data['value']; // Selected value (e.g., 'small')
    // Process the selection
}
```

#### Handling Input Values
When an input is present, the `$data` parameter in event methods (e.g., `onConfirm()`, `onDeny()`) includes a value property containing the user’s input. This value depends on the input type:

- Text, email, password, number, textarea: The entered string or number.
- Select, radio: The selected option’s key.
- Checkbox: true or false.
- File: The file data (if applicable).

### Flash Alert

Need to flash alerts across requests? In this package you can leverage Laravel’s session flashing alerts and display them in your Livewire components. This feature, inspired by version 3’s simplicity, gives you full freedom to define your own session keys and structure, allowing tailored flash alerts that appear automatically `(e.g., on mount())` after actions like redirects.

``` php
public function mount()
{
    if (session()->has('saved')) {
        LivewireAlert::title(session('saved.title'))
            ->text(session('saved.text'))
            ->success()
            ->show();
    }
}

public function changesSaved()
{
    session()->flash('saved', [
        'title' => 'Changes Saved!',
        'text' => 'You can safely close the tab!',
    ]);

    $this->redirect('/dashboard');
}
```

### Options 

The `withOptions()` method allows you to extend the alert’s configuration with any SweetAlert2-compatible options, giving you full control to customize its appearance, behavior, or functionality beyond the built-in methods. This is ideal for advanced use cases like adding inputs, modifying styles, or setting custom SweetAlert2 features.

``` php
LivewireAlert::title('Custom Alert')
    ->text('This alert has a unique style.')
    ->success()
    ->withOptions([
        'width' => '400px',
        'background' => '#f0f0f0',
        'customClass' => ['popup' => 'animate__animated animate__bounceIn'],
        'allowOutsideClick' => false,
    ])
    ->show();
```

For a comprehensive guide to customization and available configuration options, please refer to the [SweetAlert2](https://sweetalert2.github.io/#configuration) documentation.

### Dependency Injection
Who said you can only use the Facade? With this package, you can also inject the `Jantinnerezo\LivewireAlert\LivewireAlert` class directly into your Livewire component methods via dependency injection. This approach lets you access the alert functionality within the context of your component, offering a clean alternative to the Facade syntax.

``` php
use Jantinnerezo\LivewireAlert\LivewireAlert;

public function save(LivewireAlert $alert)
{
    $alert->title('Success!')
        ->text('What would you like to do?')
        ->question()
        ->withConfirmButton('Save')
        ->withCancelButton('Cancel')
        ->withDenyButton('Delete')
        ->onConfirm('saveFile', ['id' => $this->fileId])
        ->onDeny('deleteFile', ['id' => $this->fileId])
        ->onDismiss('cancelAction', ['id' => $this->fileId])
        ->show();
}
```

All methods remain available, and you can chain them fluently just like with the Facade!

### Looking for v3?

If you’re seeking documentation for livewire-alert v3, note that the last release of the version 3 series was v3.0.3, available on GitHub at [v3.0.3](https://github.com/jantinnerezo/livewire-alert/releases/tag/v3.0.3) Released on March 11, 2024, this version supports Livewire 3 and latest Laravel 12 and includes features like basic alert functionality with the `LivewireAlert` trait.

This release, however, is a major refactor of the package, introducing a new architecture and enhanced features (like the fluent Facade interface and dependency injection). As a result, the documentation below focuses on v4. 

For v3-specific usage:

``` bash 
composer require jantinnerezo/livewire-alert:^3.0
```

For ongoing projects, I recommend upgrading to v4.0 to take advantage of the improved API and feature set detailed in this documentation.

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
