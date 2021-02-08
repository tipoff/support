<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Support\Tests\TestCase;

class TestTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function test_random_or_create()
    {
        createModelStub(config('tipoff.model_class.user'));
        config('tipoff.model_class.user')::createTable();

        // Create by class name
        $className = config('tipoff.model_class.user');
        $this->assertIsString($className);
        $user = randomOrCreate($className);
        $this->assertNotNull($user);

        // Create with model instance
        $classInstance = app('user');
        $this->assertInstanceOf(Model::class, $classInstance);
        $user = randomOrCreate($classInstance);
        $this->assertNotNull($user);
    }
}
