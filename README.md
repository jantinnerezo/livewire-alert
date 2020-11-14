
# Livewire Alert
![preview](https://banners.beyondco.de/Livewire%20Alert.jpeg?theme=dark&packageName=jantinnerezo%2Flivewire-alert&pattern=architect&style=style_1&description=A+very+simple+SweetAlert2+utility+for+your+Livewire+components&md=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)
A very simple alerts utility for your existing livewire components. This package uses SweetAlert2 out-of-the-box. [https://sweetalert2.github.io/](https://sweetalert2.github.io/).

If you just want to show simple yet good-looking alert messages with nice animations this is for you!

![preview](https://raw.githubusercontent.com/jantinnerezo/livewire-alert/master/toast-preview.gif?token=AHC4OVKI6SNQ6DYWJ3AQQQK64WW6G)
![preview](https://raw.githubusercontent.com/jantinnerezo/livewire-alert/master/popup-preview.gif?token=AHC4OVKI6SNQ6DYWJ3AQQQK64WW6G)


## Installation

You can install the package via composer:

```bash

composer require jantinnerezo/livewire-alert

```

### Requirements

This package uses `livewire/livewire` (https://laravel-livewire.com/) under the hood.
Please make sure you include  it in your dependencies before using this package.

### Usage

First, add the `<x-livewire-alert::scripts />` component after `@livewireScripts`. That's it and you are good to go!

Let say you want to display a success alert message when a user successfully submitted a form:
``` php

public function submit()
{
	$this->alert('success', 'Submission successful!');
}

```

Example available events:

``` php
// Success event
$this->alert('success', 'Submission successful!');

// Information event
$this->alert('info', 'Hello, Awesome Developer!');

// Warning event
$this->alert('warning', 'You have been warned!');

// Error event
$this->alert('error', 'Whoops! you did it again!');

```
### Alert Confirmation
Livewire Alert also supports show confirmation alert on action.

First you need to include confirmation component to your livewire view.

`<x-livewire-alert::confirm onConfirmed="onConfirmedAction" onCancelled="onCancelledCallBack" />`

Make sure you add the livewire method names for `onConfirmed` and `onCancelled` props.

Livewire Alert confirmation component will call the methods for you when user hits the confirm or cancel button.

And then just add this to your livewire component class action method:

``` php
$this->confirm('Are you sure?', [
    'text' => 'You are about to delete something'
]);

return;
```
### Flash Messages
In cases you want to "flash" a success or failure message to the user
``` php
$this->flash('success', 'Submission successful!');

$this->flash('error', 'Whoops! something went wrong!');

return redirect()->to('/');

```

### Configuration
The default configurations:
``` php
[
	'position'  =>  'top-end',
	'timer'  =>  3000,
	'toast'  =>  true,
	'text' => null,
	'showCancelButton'  =>  true,
	'showConfirmButton'  =>  false
]
```
Here's an example of overriding the default configurations:

``` php
// Success event
$this->alert('success', 'You are successful!', [
	'position'  =>  'center',
	'timer'  =>  15000,
	'toast'  =>  false,
	'text'  =>  'I am a subtext',
	'showCancelButton'  =>  false,
	'showConfirmButton'  =>  false
]);
```
For more details about the configuration, see:
[https://sweetalert2.github.io/#configuration](https://sweetalert2.github.io/#configuration)
### Testing



``` bash

composer test

```



### Changelog



Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.



## Contributing



Please see [CONTRIBUTING](CONTRIBUTING.md) for details.



### Security



If you discover any security related issues, please email erezojantinn@gmail.com instead of using the issue tracker.



## Credits



-  [Jantinn Erezo](https://github.com/jantinnerezo)

-  [All Contributors](../../contributors)



## License



The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
