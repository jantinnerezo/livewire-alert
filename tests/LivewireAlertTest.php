<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert\Tests;

use Jantinnerezo\LivewireAlert\Enums\Icon;
use Jantinnerezo\LivewireAlert\Enums\Option;
use Jantinnerezo\LivewireAlert\Enums\Position;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Livewire;

class LivewireAlertTest extends TestCase
{
    public function test_it_throws_exception_if_no_component_provided(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('LivewireAlert requires a Livewire component context.');

        new LivewireAlert(null);
    }

    public function test_it_sets_title_correctly(): void
    {
        $alert = $this->livewireAlert();
        $alert->title('Test Title');

        $this->assertEquals('Test Title', $alert->getOptions()['title']);
    }

    public function test_it_sets_text_correctly(): void
    {
        $alert = $this->livewireAlert();
        $alert->text('Test Text');

        $this->assertEquals('Test Text', $alert->getOptions()['text']);
    }

    public function test_it_sets_success_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->success();

        $this->assertTrue(
            Icon::from($alert->getOptions()['icon'])->is(Icon::Success)
        );
    }

    public function test_it_sets_error_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->error();

        $this->assertTrue(
            Icon::from($alert->getOptions()['icon'])->is(Icon::Error)
        );
    }
    
    public function test_it_sets_warning_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->warning();

        $this->assertTrue(
            Icon::from($alert->getOptions()['icon'])->is(Icon::Warning)
        );
    }

    public function test_it_sets_info_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->info();

        $this->assertTrue(
            Icon::from($alert->getOptions()['icon'])->is(Icon::Info)
        );
    }

    public function test_it_sets_question_icon(): void
    {
        $alert = $this->livewireAlert();
        $alert->question();

        $this->assertTrue(
            Icon::from($alert->getOptions()['icon'])->is(Icon::Question)
        );
    }

    public function test_it_sets_position(): void
    {
        $alert = $this->livewireAlert();
        $alert->position(Position::TopEnd);
        
        $this->assertTrue(
            Position::from($alert->getOptions()['position'])->is(Position::TopEnd)
        );
    }

    public function test_it_configures_as_confirmation(): void
    {
        $alert = $this->livewireAlert();
        $alert->asConfirmation();

        $this->assertTrue(Icon::from($alert->getOptions()['icon'])->is(Icon::Question));
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

    public function test_it_sets_on_confirm_event(): void
    {
        $alert = $this->livewireAlert();
        $alert->onConfirm('confirmAction', ['id' => 123]);

        $this->assertEquals(
            ['action' => 'confirmAction', 'data' => ['id' => '123']],
            $alert->getEvents()['isConfirmed']
        );
    }

    public function test_it_merges_config_with_options(): void
    {
        config(['livewire-alert' => ['position' => 'bottom-end']]);

        $alert = $this->livewireAlert();

        $alert->title('Test')->success()->show();

        $this->assertArrayHasKey('position', $alert->getOptions());
        $this->assertEquals('bottom-end', $alert->getOptions()['position']);
        $this->assertEquals('Test', $alert->getOptions()['title']);
    }

    protected function livewireAlert(): LivewireAlert
    {
        return new LivewireAlert(
            Livewire::test(TestComponent::class)->instance()
        );
    }
}