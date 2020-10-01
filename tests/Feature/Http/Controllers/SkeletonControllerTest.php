<?php


namespace Spatie\Skeleton\Tests\Feature\Http\Controllers;

class SkeletonControllerTest extends \Spatie\Skeleton\Tests\TestCase
{
    /** @test */
    public function it_returns_ok()
    {
        // Test hard-coded routes...
        $this
            ->get('/grok/Spatie/Skeleton/string')
            ->assertOk()
            ->assertSee('Hello string via global url.');
        $this
            ->get('/grok/Spatie/Skeleton/blade')
            ->assertOk()
            ->assertSee('Hello from blade in Spatie/Skeleton/groks/index');
        $this
            ->get('/grok/Spatie/Skeleton/controller')
            ->assertOk()
            ->assertSee('Hello from: Spatie\Skeleton\Http\Controllers\SkeletonController::sample');


        // Test user-defined routes...
        // Reproduce in routes/web.php like so
        //  Route::bladeprefix('staff');
        //  http://test-spatie.test/staff/Spatie/Skeleton/string
        //  http://test-spatie.test/staff/Spatie/Skeleton/blade
        //  http://test-spatie.test/staff/Spatie/Skeleton/controller
        $userDefinedBladePrefix = $this->userDefinedBladePrefix; // user will do this in routes/web.php Route::bladeprefix('url');

        // string
        $this
            ->get("/$userDefinedBladePrefix/Spatie/Skeleton/string")
            ->assertOk()
            #->assertSee('hw(Spatie\Skeleton\Http\Controllers\SkeletonController)');
        ->assertSee('Hello string via blade prefix');

        // blade
        $this
            ->get("/$userDefinedBladePrefix/Spatie/Skeleton/blade")
            ->assertOk()
            ->assertSee('Hello from blade in Spatie/Skeleton/groks/index');

        // controller
        $this
            ->get("/$userDefinedBladePrefix/Spatie/Skeleton/controller")
            ->assertOk()
            ->assertSee('Hello from: Spatie\Skeleton\Http\Controllers\SkeletonController::sample');
    }
}
