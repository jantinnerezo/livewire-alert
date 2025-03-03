
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

First, require the package with Composer:

``` bash
composer require jantinnerezo/livewire-alert
```

Next, install SweetAlert2 via npm:

``` bash
npm install sweetalert2
```

After installing SweetAlert2, import it into your `resources/js/app.js` file

```
import Swal from 'sweetalert2'

window.Swal = Swal
```

If you prefer not to use npm, you can include SweetAlert2 directly via CDN. Add the following script to your Blade layout file (e.g., resources/views/layouts/app.blade.php) before the closing </body> tag:

``` html
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
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
When an input is present, the $data parameter in event methods (e.g., `onConfirm()`, `onDeny()`) includes a value property containing the user’s input. This value depends on the input type:

- Text, email, password, number, textarea: The entered string or number.
- Select, radio: The selected option’s key.
- Checkbox: true or false.
- File: The file data (if applicable).
