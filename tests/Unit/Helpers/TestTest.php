<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Services\BaseService;
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

    /** @test */
    public function test_nova_with_existing_resource()
    {
        createModelStub(config('tipoff.model_class.user'));
        createNovaResourceStub(config('tipoff.nova_class.user'), config('tipoff.model_class.user'));

        $user = nova('user');
        $this->assertStringContainsString('\\User', $user);

        $novaUser = nova('nova.user');
        $this->assertEquals($user, $novaUser);
    }

    /** @test */
    public function test_nova_unknown_alias()
    {
        $result = nova('usr');
        $this->assertNull($result);
    }

    /** @test */
    public function test_nova_unknown_class()
    {
        $result = nova('order');
        $this->assertNull($result);
    }

    /** @test */
    public function test_morphClass_with_existing_resource()
    {
        createModelStub(config('tipoff.model_class.user'));

        $user = morphClass('user');
        $this->assertStringContainsString('\\User', $user);
    }

    /** @test */
    public function test_morphClass_unknown_alias()
    {
        $result = morphClass('usr');
        $this->assertNull($result);
    }

    /** @test */
    public function test_morphClass_unknown_class()
    {
        $result = morphClass('order');
        $this->assertNull($result);
    }

    /** @test */
    public function test_find_model()
    {
        createModelStub(config('tipoff.model_class.user'));
        config('tipoff.model_class.user')::createTable();

        $className = config('tipoff.model_class.user');
        $user = randomOrCreate($className);

        // No binding
        $result = findModel(BaseModelInterface::class, $user->id);
        $this->assertNull($result);

        // With binding
        $this->app->bind(BaseModelInterface::class, $className);
        $result = findModel(BaseModelInterface::class, $user->id);
        $this->assertNotNull($result);
        $this->assertEquals($result->getId(), $user->id);
        $this->assertInstanceOf($className, $result);
    }

    /** @test */
    public function test_find_model_or_fail()
    {
        createModelStub(config('tipoff.model_class.user'));
        config('tipoff.model_class.user')::createTable();

        $className = config('tipoff.model_class.user');
        $user = randomOrCreate($className);

        // No binding
        $result = findModelOrFail(BaseModelInterface::class, $user->id);
        $this->assertNull($result);

        $result = findModelOrFail(BaseModelInterface::class, 12324);
        $this->assertNull($result);

        // With binding
        $this->app->bind(BaseModelInterface::class, $className);
        $result = findModelOrFail(BaseModelInterface::class, $user->id);
        $this->assertNotNull($result);
        $this->assertEquals($result->getId(), $user->id);
        $this->assertInstanceOf($className, $result);

        $this->expectException(ModelNotFoundException::class);
        $this->expectExceptionMessage('No query results for model');
        findModelOrFail(BaseModelInterface::class, 12313);
    }

    /** @test */
    public function test_find_service()
    {
        // No binding
        $result = findService(BaseService::class);
        $this->assertNull($result);

        // With binding
        $this->app->singleton(BaseService::class, TestService::class);
        $result = findService(BaseService::class);
        $this->assertNotNull($result);
        $this->assertInstanceOf(BaseService::class, $result);
    }
}

class TestService implements BaseService
{
}
