<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Resolver;

use Illuminate\Foundation\AliasLoader;
use Tipoff\Support\Tests\TestCase;

class ModelResolvingTest extends TestCase
{
    /** @test */
    public function test_if_model_aliases_are_loaded()
    {
        $loader = AliasLoader::getInstance();

        $this->assertEquals(
            config('tipoff.model_class'),
            array_intersect($loader->getAliases(), config('tipoff.model_class'))
        );
    }
}

