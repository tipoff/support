<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Resolver;

use Tipoff\Support\Tests\TestCase;

class ModelResolvingTest extends TestCase
{
    /** @test */
    public function test_if_model_aliases_are_loaded()
    {
        $this->assertEquals(
            config('tipoff.model_class.user'),
            $this->app->getAlias('user')
        );
    }

    /** @test */
    public function test_if_nova_model_aliases_are_loaded()
    {
        $this->assertEquals(
            config('tipoff.nova_class.user'),
            $this->app->getAlias('nova.user')
        );
    }

    /** @test */
    public function test_if_class_can_be_overwrited()
    {
        $this->app->alias(\Tipoff\Support\Models\BaseModel::class, 'user');
        $this->assertEquals(get_class(resolve('user')), \Tipoff\Support\Models\BaseModel::class);
    }
}
