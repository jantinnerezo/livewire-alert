<?php

namespace Jantinnerezo\LivewireAlert\Tests;

use Orchestra\Testbench\TestCase;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LivewireAlertTest extends TestCase
{
    protected $livewireAlertMock;

    protected function setUp(): void
    {
        $this->livewireAlertMock = $this->getMockForTrait(LivewireAlert::class);
    }

    protected function tearDown(): void
    {
        $this->livewireAlertMock = null;
    }

    /** @test */
    public function alert_options_is_array()
    {
        $this->assertIsArray($this->livewireAlertMock->alertOptions()->toArray());
    }

    /** @test */
    public function alert_options_is_not_empty()
    {
        $this->assertNotEmpty($this->livewireAlertMock->alertOptions());
    }

    /** @test */
    public function alert_options_is_not_null()
    {
        $this->assertNotNull($this->livewireAlertMock->alertOptions());
    }

    /** @test */
    public function test_alert_position()
    {
        $this->assertContains(
            $this->livewireAlertMock->alertOptions()->get('position'),
            [
                'top',
                'top-start',
                'top-end',
                'center',
                'center-start',
                'center-end',
                'bottom',
                'bottom-start',
                'bottom-end'
            ]
        );
    }
}
