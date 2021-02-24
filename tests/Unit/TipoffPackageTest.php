<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Nova;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Services\BaseService;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Tests\TestCase;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;
use Tipoff\Support\Contracts\Taxes\TaxRequest;
use Tipoff\Support\Contracts\Taxes\TaxRequestItem;

class TipoffPackageTest extends TestCase
{
    /** @test */
    public function policies_are_merged()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasPolicies([Model::class => 'b'])
                ->hasPolicies([BaseModel::class => 'c'])
                ->hasPolicies([Model::class => 'c']);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(2, $package->policies);
        $this->assertEquals([
            BaseModel::class => 'c',
            Model::class => 'c',
        ], $package->policies);
    }

    /** @test */
    public function policies_require_models()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('notamodel is not a Model instance');

        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasPolicies(['notamodel' => 'b']);
        });

        $provider->register()->getPackage();
    }

    /** @test */
    public function model_interfaces_are_merged()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasModelInterfaces([BaseModelInterface::class => BaseModel::class])
                ->hasModelInterfaces([TestModelInterface::class => TestModel::class])
                ->hasModelInterfaces([BaseModelInterface::class => BaseModel::class]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(2, $package->modelInterfaces);
        $this->assertEquals([
            BaseModelInterface::class => BaseModel::class,
            TestModelInterface::class => TestModel::class,
        ], $package->modelInterfaces);
    }

    /** @test */
    public function model_interfaces_require_valid_implementation()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tipoff\Support\Models\BaseModel does not implement Tipoff\Support\Tests\Unit\TestModelInterface');

        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasModelInterfaces([TestModelInterface::class => BaseModel::class]);
        });

        $provider->register()->getPackage();
    }

    /** @test */
    public function services_are_merged()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasServices([BaseService::class => BaseServiceImplementation::class])
                ->hasServices([TestService::class => TestServiceImplementation::class])
                ->hasServices([BaseService::class => BaseServiceImplementation::class]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(2, $package->services);
        $this->assertEquals([
            BaseService::class => BaseServiceImplementation::class,
            TestService::class => TestServiceImplementation::class,
        ], $package->services);
    }

    /** @test */
    public function services_require_valid_implementation()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Tipoff\Support\Tests\Unit\BaseServiceImplementation does not implement Tipoff\Support\Tests\Unit\TestService');

        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasServices([TestService::class => BaseServiceImplementation::class]);
        });

        $provider->register()->getPackage();
    }

    /** @test */
    public function events_are_merged_properly()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasEvents([
                    'a' => [
                        '1',
                        '2',
                        '3',
                    ],
                    'b' => [
                        '4',
                        '5',
                        '6',
                    ],
                ])
                ->hasEvents([
                    'a' => [
                        '3',
                        '4',
                    ],
                    'b' => [
                        '4',
                        '5',
                        '6',
                    ],
                    'c' => [
                        '4',
                        '5',
                        '6',
                    ],
                ]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(3, $package->events);
        $this->assertEquals([
            'a' => [
                '1',
                '2',
                '3',
                '4',
            ],
            'b' => [
                '4',
                '5',
                '6',
            ],
            'c' => [
                '4',
                '5',
                '6',
            ],
        ], $package->events);
    }

    /** @test */
    public function nova_resources_are_merged()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package->hasNovaResources([DemoNovaResource::class]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(1, $package->novaResources);
        $this->assertEquals([DemoNovaResource::class], $package->novaResources);
    }

    /** @test */
    public function bindings_are_merged()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasBindings([TaxRequest::class => 'b'])
                ->hasBindings([TaxRequestItem::class => 'c'])
                ->hasBindings([TaxRequest::class => 'c']);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(2, $package->bindings);
        $this->assertEquals([
            TaxRequestItem::class => 'c',
            TaxRequest::class => 'c',
        ], $package->bindings);
    }
}

class TestServiceProvider extends TipoffServiceProvider
{
    private \Closure $testSetup;

    public function __construct($app, \Closure $testSetup)
    {
        parent::__construct($app);

        $this->testSetup = $testSetup;
    }

    public function configureTipoffPackage(TipoffPackage $package): void
    {
        ($this->testSetup)($package->name('test'));
    }

    public function getPackage(): TipoffPackage
    {
        return $this->package;
    }
}

interface TestService extends BaseService
{
}

class BaseServiceImplementation implements BaseService
{
}

class TestServiceImplementation implements TestService
{
}

interface TestModelInterface extends BaseModelInterface
{
}

class TestModel extends BaseModel implements TestModelInterface
{
}

class DemoNovaResource extends Nova
{
}
