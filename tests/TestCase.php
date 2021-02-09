<?php

namespace Tipoff\Support\Tests;

use Tipoff\Support\SupportServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
        ];
    }
}
