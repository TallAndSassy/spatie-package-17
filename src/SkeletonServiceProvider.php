<?php

namespace Spatie\Skeleton;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Spatie\Skeleton\Commands\SkeletonCommand;
use Spatie\Skeleton\Http\Controllers\SkeletonController;
use Illuminate\Support\Facades\Route;

class SkeletonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/skeleton.php' => config_path('skeleton.php'),
                ],
                'config'
            );

            $this->publishes(
                [
                    __DIR__ . '/../resources/views' => base_path('resources/views/vendor/skeleton'),
                ],
                'views'
            );

            $migrationFileName = 'create_skeleton_table.php';
            if (!$this->migrationFileExists($migrationFileName)) {
                $this->publishes(
                    [
                        __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path(
                            'migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName
                        ),
                    ],
                    'migrations'
                );
            }

            $this->commands(
                [
                    SkeletonCommand::class,
                ]
            );
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bladeprefix');


        Route::macro(
            'bladeprefix',
//             JJ you left off mosstly assuming that I need to replace the above
//            with a new bladeprefix question, defaulting to 'tassy'
//            You might need to add a manual step to rename the file
            function (string $prefix) {
                Route::prefix($prefix)->group(

                    function () {
                        // Sample routes that only show while developing...
                        if (App::environment(['local', 'testing'])) {
                            // prefixed url to string
                            Route::get(
                                '/Spatie/Skeleton/string', // you will absolutely need a prefix in your url
                                function () {
                                    return "Hello string via blade prefix";
                                }
                            );

                            // prefixed url to blade view
                            Route::get(
                                '/Spatie/Skeleton/blade',
                                function () {
                                    return view('bladeprefix::groks/index');
                                }
                            );

                            // prefixed url to controller
                            Route::get(
                                '/Spatie/Skeleton/controller',
                                [SkeletonController::class, 'sample']
                            );
                        }
                    }
                );
            }
        );


        if (App::environment(['local', 'testing'])) {
            // global url to string
            Route::get(
                '/grok/Spatie/Skeleton/string',
                function () {
                    return "Hello string via global url.";
                }
            );

            // global url to blade view
            Route::get(
                '/grok/Spatie/Skeleton/blade',
                function () {
                    return view('bladeprefix::groks/index');
                }
            );

            // global url to controller
            Route::get('/grok/Spatie/Skeleton/controller', [SkeletonController::class, 'sample']);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/skeleton.php', 'skeleton');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
