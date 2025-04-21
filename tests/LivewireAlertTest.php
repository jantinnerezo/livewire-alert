<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Tests;

use Jantinnerezo\LivewireAlert\Enums\Event;
use Jantinnerezo\LivewireAlert\Enums\Icon;
use Jantinnerezo\LivewireAlert\Enums\Option;
use Jantinnerezo\LivewireAlert\Enums\Position;
use Jantinnerezo\LivewireAlert\Exceptions\InvalidPositionException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;

class LivewireAlertTest extends TestCase
{
    #[Test]
    public function it_throws_exception_if_no_component_provided(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('LivewireAlert requires a Livewire component context.');

        new LivewireAlert(null);
    }

    #[Test]
    public function it_sets_title_correctly(): void
    {
        $alert = $this->livewireAlert();
        $alert->title('Test Title');

        $this->assertEquals('Test Title', $alert->getOptions()['title']);
    }

    #[Test]
    public function it_sets_text_correctly(): void
    {
        $alert = $this->livewireAlert();
        $alert->text('Test Text');

        $this->assertEquals('Test Text', $alert->getOptions()['text']);
    }

    #[Test]
    public function it_sets_success_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->success();

        $this->assertTrue(
            Icon::from(
                $alert->getOptions()[Option::Icon->value]
            )->is(Icon::Success)
        );
    }

    #[Test]
    public function it_sets_error_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->error();

        $this->assertTrue(
            Icon::from(
                $alert->getOptions()[Option::Icon->value]
            )->is(Icon::Error)
        );
    }
    
    #[Test]
    public function it_sets_warning_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->warning();

        $this->assertTrue(
            Icon::from(
                $alert->getOptions()[Option::Icon->value]
            )->is(Icon::Warning)
        );
    }

    #[Test]
    public function it_sets_info_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->info();

        $this->assertTrue(
            Icon::from(
                $alert->getOptions()[Option::Icon->value])
            ->is(Icon::Info)
        );
    }

    #[Test]
    public function it_sets_question_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->question();

        $this->assertTrue(
            Icon::from(
                $alert->getOptions()[Option::Icon->value]
            )->is(Icon::Question)
        );
    }

    #[Test]
    public function it_sets_position_with_enum_parameter(): void
    {
        $alert = $this->livewireAlert();
        $alert->position(Position::Top);
        
        $this->assertTrue(
            Position::from(
                $alert->getOptions()[Option::Position->value]->value
            )->is(Position::Top)
        );
    }

    #[Test]
    public function it_sets_position_with_string_parameter(): void
    {
        $alert = $this->livewireAlert();
        $alert->position('top');
        
        $this->assertTrue(
            Position::from('top')->is(Position::Top)
        );
    }

    #[Test]
    public function it_throws_invalid_position_value(): void
    {
        $this->expectException(InvalidPositionException::class);
        $this->expectExceptionMessage('Invalid position value. see:  Jantinnerezo\LivewireAlert\Enums\Position for available values.');

        $alert = $this->livewireAlert();
        $alert->position('start');
    }

    #[Test]
    public function it_configures_as_toast(): void
    {
        $alert = $this->livewireAlert();
        $alert->toast();

        $this->assertTrue(
            $alert->getOptions()[Option::Toast->value]
        );
        $this->assertFalse(
            $alert->getOptions()[Option::Backdrop->value]
        );
    }

    #[Test]
    public function it_sets_timer(): void
    {
        $alert = $this->livewireAlert();
        $alert->timer(5000);

        $this->assertEquals(
            5000,
            $alert->getOptions()[Option::Timer->value]
        );
    }

    #[Test]
    public function it_sets_html(): void
    {
        $alert = $this->livewireAlert();
        $alert->html('<strong>Test HTML</strong>');

        $this->assertEquals(
            '<strong>Test HTML</strong>',
            $alert->getOptions()[Option::Html->value]
        );
    }

    #[Test]
    public function it_sets_html_with_closure(): void
    {
        $alert = $this->livewireAlert();
        $alert->html(fn () => '<strong>Test HTML</strong>');

        $this->assertEquals(
            '<strong>Test HTML</strong>',
            $alert->getOptions()[Option::Html->value]
        );
    }

    #[Test]
    public function it_sets_html_with_closure_returning_non_string(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The closure must return a string');

        $alert = $this->livewireAlert();
        $alert->html(fn () => 10);
    }

    #[Test]
    public function it_has_confirm_button_with_text_from_config(): void
    {
        $alert = $this->livewireAlert();
        $alert->withConfirmButton();

        $this->assertTrue(
            $alert->getOptions()[Option::ShowConfirmButton->value]
        );
        $this->assertEquals(
            config('livewire-alert.confirmButtonText'),
            $alert->getOptions()[Option::ConfirmButtonText->value]
        );
    }

    #[Test]
    public function it_has_confirm_button_with_text_defined(): void
    {
        $alert = $this->livewireAlert();
        $alert->withConfirmButton('Alright');

        $this->assertEquals(
            'Alright',
            $alert->getOptions()[Option::ConfirmButtonText->value]
        );
    }

    #[Test]
    public function it_has_cancel_button_with_text_from_config(): void
    {
        $alert = $this->livewireAlert();
        $alert->withCancelButton();

        $this->assertTrue(
            $alert->getOptions()[Option::ShowCancelButton->value]
        );
        $this->assertEquals(
            config('livewire-alert.cancelButtonText'),
            $alert->getOptions()[Option::CancelButtonText->value]
        );
    }

    #[Test]
    public function it_has_cancel_button_with_text_defined(): void
    {
        $alert = $this->livewireAlert();
        $alert->withCancelButton('Cancel Please');

        $this->assertEquals(
            'Cancel Please',
            $alert->getOptions()[Option::CancelButtonText->value]
        );
    }

    #[Test]
    public function it_has_deny_button_with_text_from_config(): void
    {
        $alert = $this->livewireAlert();
        $alert->withDenyButton();

        $this->assertTrue(
            $alert->getOptions()[Option::ShowDenyButton->value]
        );
        $this->assertEquals(
            config('livewire-alert.denyButtonText'),
            $alert->getOptions()[Option::DenyButtonText->value]
        );
    }

    #[Test]
    public function it_has_deny_button_with_text_defined(): void
    {
        $alert = $this->livewireAlert();
        $alert->withDenyButton('Deny');

        $this->assertEquals(
            'Deny',
            $alert->getOptions()[Option::DenyButtonText->value]
        );
    }

    #[Test]
    public function it_changes_confirm_button_text(): void
    {
        $alert = $this->livewireAlert();
        $alert->confirmButtonText('OK');

        $this->assertEquals(
            'OK',
            $alert->getOptions()[Option::ConfirmButtonText->value]
        );

        $alert->confirmButtonText('Yes');

        $this->assertEquals(
            'Yes',
            $alert->getOptions()[Option::ConfirmButtonText->value]
        );
    }

    #[Test]
    public function it_changes_cancel_button_text(): void
    {
        $alert = $this->livewireAlert();
        $alert->cancelButtonText('Cancel');

        $this->assertEquals(
            'Cancel',
            $alert->getOptions()[Option::CancelButtonText->value]
        );

        $alert->cancelButtonText('Cancel Please');

        $this->assertEquals(
            'Cancel Please',
            $alert->getOptions()[Option::CancelButtonText->value]
        );
    }

    #[Test]
    public function it_changes_deny_button_text(): void
    {
        $alert = $this->livewireAlert();
        $alert->denyButtonText('No');

        $this->assertEquals(
            'No',
            $alert->getOptions()[Option::DenyButtonText->value]
        );

        $alert->denyButtonText('Nope');

        $this->assertEquals(
            'Nope',
            $alert->getOptions()[Option::DenyButtonText->value]
        );
    }

    #[Test]
    public function it_changes_confirm_button_color(): void
    {
        $alert = $this->livewireAlert();
        $alert->confirmButtonColor('green');

        $this->assertEquals(
            'green',
            $alert->getOptions()[Option::ConfirmButtonColor->value]
        );

        $alert->confirmButtonColor('red');

        $this->assertEquals(
            'red',
            $alert->getOptions()[Option::ConfirmButtonColor->value]
        );
    }

    #[Test]
    public function it_changes_cancel_button_color(): void
    {
        $alert = $this->livewireAlert();
        $alert->cancelButtonColor('gray');

        $this->assertEquals(
            'gray',
            $alert->getOptions()[Option::CancelButtonColor->value]
        );

        $alert->cancelButtonColor('orange');

        $this->assertEquals(
            'orange',
            $alert->getOptions()[Option::CancelButtonColor->value]
        );
    }

    #[Test]
    public function it_changes_deny_button_color(): void
    {
        $alert = $this->livewireAlert();
        $alert->denyButtonColor('red');

        $this->assertEquals(
            'red',
            $alert->getOptions()[Option::DenyButtonColor->value]
        );

        $alert->denyButtonColor('blue');

        $this->assertEquals(
            'blue',
            $alert->getOptions()[Option::DenyButtonColor->value]
        );
    }

    #[Test]
    public function it_configures_as_confirm(): void
    {
        $alert = $this->livewireAlert();
        $alert->asConfirm();

        $this->assertTrue(Icon::from(
            $alert->getOptions()[Option::Icon->value]
        )->is(Icon::Question));

        $this->assertTrue(
            $alert->getOptions()[Option::ShowConfirmButton->value]
        );
        $this->assertTrue(
            $alert->getOptions()[Option::ShowDenyButton->value]
        );
        $this->assertNull(
            $alert->getOptions()[Option::Timer->value]
        );
    }

    #[Test]
    public function it_sets_on_confirm_event(): void
    {
        $alert = $this->livewireAlert();
        $alert->onConfirm('confirmAction', ['id' => 123]);

        $this->assertEquals(
            ['action' => 'confirmAction', 'data' => ['id' => '123']],
            $alert->getEvents()[Event::IsConfirmed->value]
        );
    }

    #[Test]
    public function it_sets_on_deny_event(): void
    {
        $alert = $this->livewireAlert();
        $alert->onDeny('denyAction', ['id' => 123]);

        $this->assertEquals(
            ['action' => 'denyAction', 'data' => ['id' => '123']],
            $alert->getEvents()[Event::IsDenied->value]
        );
    }

    #[Test]
    public function it_sets_on_dismiss_event(): void
    {
        $alert = $this->livewireAlert();
        $alert->onDismiss('dismissAction', ['id' => 123]);

        $this->assertEquals(
            ['action' => 'dismissAction', 'data' => ['id' => '123']],
            $alert->getEvents()[Event::IsDismissed->value]
        );
    }

    #[Test]
    public function it_sets_additional_options(): void
    {
        $alert = $this->livewireAlert();
        $alert->withOptions([
            Option::Input->value => 'text',
            Option::InputLabel->value => 'Enter something',
        ]);

        $this->assertEquals(
            'text',
            $alert->getOptions()[Option::Input->value]
        );
        $this->assertEquals(
            'Enter something',
            $alert->getOptions()[Option::InputLabel->value]
        );
    }

    #[Test]
    public function it_merges_config_with_options(): void
    {
        config([
            'livewire-alert' => ['position' => Position::BottomEnd->value]
        ]);

        $alert = $this->livewireAlert();

        $alert->title('Test')->success()->show();

        $this->assertArrayHasKey(Option::Position->value, $alert->getOptions());
        $this->assertEquals(
            Position::BottomEnd->value, 
            $alert->getOptions()['position']
        );
        $this->assertEquals(
            'Test', 
            $alert->getOptions()[Option::Title->value]
        );
    }

    #[Test]
    public function it_get_events(): void
    {
        $alert = $this->livewireAlert();
        $alert->onConfirm('confirmAction', ['id' => 123]);
        $alert->onDeny('denyAction', ['id' => 123]);
        $alert->onDismiss('dismissAction', ['id' => 123]);

        $this->assertCount(3, $alert->getEvents());
    }

    protected function livewireAlert(): LivewireAlert
    {
        return new LivewireAlert(
            Livewire::test(TestComponent::class)->instance()
        );
    }
}