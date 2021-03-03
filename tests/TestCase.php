<?php

namespace Tipoff\Support\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Illuminate\Testing\TestView;
use Orchestra\Testbench\TestCase as Orchestra;
use Tipoff\Support\SupportServiceProvider;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function blade(string $template, array $data = [])
    {
        $tempDirectory = sys_get_temp_dir();

        if (! in_array($tempDirectory, ViewFacade::getFinder()->getPaths())) {
            ViewFacade::addLocation(sys_get_temp_dir());
        }

        $tempFile = tempnam($tempDirectory, 'laravel-blade').'.blade.php';

        // Fix for Github Actions ci/cd on windows - this strips any .tmp from the tempfile name generated
        $tempFile = preg_replace('/\.tmp\.blade/', '.blade', $tempFile);

        file_put_contents($tempFile, $template);

        return new TestView(view(Str::before(basename($tempFile), '.blade.php'), $data));
    }

    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // No common base, so add view dir ourselves for our own tests
        $paths = array_merge($app['config']->get('view.paths'), [
            __DIR__ . '/../resources/views',
        ]);
        $app['config']->set('view.paths', $paths);
    }
}
