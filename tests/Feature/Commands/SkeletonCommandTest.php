<?php


namespace Spatie\Skeleton\Tests\Feature\Commands;

class SkeletonCommandTest extends \Spatie\Skeleton\Tests\TestCase
{
    /** @test */
    public function test_command_works()
    {
        $this->artisan('hw')->assertExitCode(0);
        $this->artisan('hw')->expectsOutput('Spatie/Skeleton/hw/tbd');
    }
}
