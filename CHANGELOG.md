# Changelog

All notable changes to `livewire-alert` will be documented in this file

## 1.0.0

-   initial release

## 1.2.0

-   Added Livewire 2.0 support
-   Laravel 8.0 support

## 2.0
- Removed LivewireAlert trait
- Added livewire component macro for calling alert directly instead of using trait on each livewire components.
- Fixed Laravel 8.0 and livewire 2.0 conflict because of blade directive for scripts.
- Added script component to embed sweetalert2

## 2.0.1
- Added support for session flash messages out-of-the-box.

## 2.0.2
- Added support for alert confirmation.

## 2.1
- Added PHP 8.0 support
- Added multiple confirmation alerts on a single livewire component
- Refactor confirmation alerts to use livewire event listeners to handle callbacks.
- Removed the need to use Alpine.js, it's no longer required.
- Refactor Alpine.js code to vanilla js for alert confirmation.
- Refactor alert javascript codes.
- Added config.php file with default SweetAlert2 config.
- Removed SweetAlert2 script tag, should no longer be included by default.

## 2.1.1
- Separate config array for alert and confirm

## 2.1.2
- Added publishable config

## 2.1.3
- Optimize blade component script code to utilize config
- Added more default config to livewire-alert.php
