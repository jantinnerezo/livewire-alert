<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Enums;

enum Option: string
{
    case Title = 'title';
    case TitleText = 'titleText';
    case Html = 'html';
    case Text = 'text';
    case Icon = 'icon';
    case IconColor = 'iconColor';
    case IconHtml = 'iconHtml';
    case ShowClass = 'showClass';
    case HideClass = 'hideClass';
    case Footer = 'footer';
    case Backdrop = 'backdrop';
    case Toast = 'toast';
    case Target = 'target';
    case Input = 'input';
    case Width = 'width';
    case Padding = 'padding';
    case Color = 'color';
    case Background = 'background';
    case Position = 'position';
    case Grow = 'grow';
    case CustomClass = 'customClass';
    case Timer = 'timer';
    case TimerProgressBar = 'timerProgressBar';
    case HeightAuto = 'heightAuto';
    case AllowOutsideClick = 'allowOutsideClick';
    case AllowEscapeKey = 'allowEscapeKey';
    case AllowEnterKey = 'allowEnterKey';
    case StopKeydownPropagation = 'stopKeydownPropagation';
    case KeydownListenerCapture = 'keydownListenerCapture';
    case ShowConfirmButton = 'showConfirmButton';
    case ShowDenyButton = 'showDenyButton';
    case ShowCancelButton = 'showCancelButton';
    case ConfirmButtonText = 'confirmButtonText';
    case DenyButtonText = 'denyButtonText';
    case CancelButtonText = 'cancelButtonText';
    case ConfirmButtonColor = 'confirmButtonColor';
    case DenyButtonColor = 'denyButtonColor';
    case CancelButtonColor = 'cancelButtonColor';
    case ConfirmButtonAriaLabel = 'confirmButtonAriaLabel';
    case DenyButtonAriaLabel = 'denyButtonAriaLabel';
    case CancelButtonAriaLabel = 'cancelButtonAriaLabel';
    case ButtonsStyling = 'buttonsStyling';
    case ReverseButtons = 'reverseButtons';
    case FocusConfirm = 'focusConfirm';
    case ReturnFocus = 'returnFocus';
    case FocusDeny = 'focusDeny';
    case FocusCancel = 'focusCancel';
    case ShowCloseButton = 'showCloseButton';
    case CloseButtonHtml = 'closeButtonHtml';
    case CloseButtonAriaLabel = 'closeButtonAriaLabel';
    case LoaderHtml = 'loaderHtml';
    case ShowLoaderOnConfirm = 'showLoaderOnConfirm';
    case ShowLoaderOnDeny = 'showLoaderOnDeny';
    case ScrollbarPadding = 'scrollbarPadding';
    case PreConfirm = 'preConfirm';
    case PreDeny = 'preDeny';
    case ReturnInputValueOnDeny = 'returnInputValueOnDeny';
    case ImageUrl = 'imageUrl';
    case ImageWidth = 'imageWidth';
    case ImageHeight = 'imageHeight';
    case ImageAlt = 'imageAlt';
    case InputLabel = 'inputLabel';
    case InputPlaceholder = 'inputPlaceholder';
    case InputValue = 'inputValue';
    case InputOptions = 'inputOptions';
    case InputAutoTrim = 'inputAutoTrim';
    case InputAttributes = 'inputAttributes';
    case InputValidator = 'inputValidator';
    case ValidationMessage = 'validationMessage';
    case ProgressSteps = 'progressSteps';
    case CurrentProgressStep = 'currentProgressStep';
    case ProgressStepsDistance = 'progressStepsDistance';
    case WillOpen = 'willOpen';
    case DidOpen = 'didOpen';
    case DidRender = 'didRender';
    case WillClose = 'willClose';
    case DidClose = 'didClose';
    case DidDestroy = 'didDestroy';

    public function is(self $option): bool
    {
        return $this === $option;
    }

    /**
     * @return array<string>
     */
    public static function values(): array
    {
        return array_map(
            fn (Option $option) => $option->value,
            self::cases()
        );
    }
    
    /**
     * @return array<self>
     */
    public static function callbacks(): array
    {
        return [
            Option::AllowOutsideClick,
            Option::AllowEscapeKey,
            Option::AllowEnterKey,
            Option::LoaderHtml,
            Option::InputOptions,
            Option::InputValidator,
            Option::PreConfirm,
            Option::PreDeny,
            Option::DidClose,
            Option::DidDestroy,
            Option::DidOpen,
            Option::DidRender,
            Option::WillClose,
            Option::WillOpen,
        ];
    }
}
