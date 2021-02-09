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
    }
}
