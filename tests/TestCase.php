<?php

namespace Tipoff\Support\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Tipoff\Support\SupportServiceProvider;

class TestCase extends Orchestra
{
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
