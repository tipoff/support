<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Cashier\Payment;
use Stripe\PaymentIntent;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Models\TestModelStub;
use Tipoff\Support\Tests\TestCase;

class BaseModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test  */
    public function get_id()
    {
        TestModel::createTable();
        ;

        /** @var TestModel $model */
        $model = TestModel::create([]);
        $this->assertNotNull($model);

        $this->assertEquals($model->id, $model->getId());
    }

    /** @test  */
    public function find()
    {
        TestModel::createTable();
        ;

        $result = TestModel::find(1);
        $this->assertNull($result);

        /** @var TestModel $model */
        $model = TestModel::create([]);

        $result = TestModel::find($model->id);
        $this->assertNotNull($result);

        $this->assertEquals($model->getId(), $result->getId());
    }

    /** @test  */
    public function find_or_fail()
    {
        TestModel::createTable();
        ;

        /** @var TestModel $model */
        $model = TestModel::create([]);

        $result = TestModel::findOrFail($model->id);
        $this->assertNotNull($result);

        $this->assertEquals($model->getId(), $result->getId());

        $this->expectException(ModelNotFoundException::class);

        TestModel::findOrFail(1234);
    }

    /** @test  */
    public function default_is_owner_is_false()
    {
        TestModel::createTable();
        ;

        /** @var TestModel $model */
        $model = TestModel::create([]);
        $this->assertNotNull($model);

        $this->assertFalse($model->isOwner($model));
    }

    /** @test  */
    public function default_visible_by_is_hidden()
    {
        TestModel::createTable();
        ;

        foreach (range(1, 10) as $i) {
            TestModel::create([]);
        }

        $this->assertDatabaseCount('test_models', 10);

        $user = TestModel::create([]);
        $models = TestModel::query()->visibleBy($user)->get();

        $this->assertCount(0, $models);
    }

    /** @test  */
    public function always_visible()
    {
        TestModel::createTable();
        ;

        foreach (range(1, 10) as $i) {
            TestModel::create([]);
        }

        $this->assertDatabaseCount('test_models', 10);

        $user = TestModel::create([]);
        $models = TestModel::query()->alwaysVisible($user)->get();

        $this->assertCount(11, $models);
    }

    /** @test  */
    public function never_visible()
    {
        TestModel::createTable();
        ;

        foreach (range(1, 10) as $i) {
            TestModel::create([]);
        }

        $this->assertDatabaseCount('test_models', 10);

        $user = TestModel::create([]);
        $models = TestModel::query()->neverVisible($user)->get();

        $this->assertCount(0, $models);
    }
}

class TestModel extends BaseModel implements UserInterface
{
    use TestModelStub;
    use Authenticatable;
    use Authorizable;

    public function scopeNeverVisible(Builder $query): Builder
    {
        return parent::scopeNeverVisible($query);
    }

    public function scopeAlwaysVisible(Builder $query): Builder
    {
        return parent::scopeAlwaysVisible($query);
    }

    public function hasRole($roles, string $guard = null): bool
    {
        return false;
    }

    public function hasPermissionTo($permission, $guardName = null): bool
    {
        return false;
    }
}
