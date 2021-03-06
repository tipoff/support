<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Laravel\Nova\Nova;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Services\BaseService;
use Tipoff\Support\Contracts\Taxes\TaxRequest;
use Tipoff\Support\Contracts\Taxes\TaxRequestItem;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Tests\TestCase;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

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
            $package
                ->hasNovaResources([DemoNovaResource::class])
                ->hasNovaResources([DemoNovaResource::class]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(1, $package->novaResources);
        $this->assertEquals([DemoNovaResource::class], $package->novaResources);
    }

    /** @test */
    public function nova_tools_are_added()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasNovaTools([
                    new DemoNovaResource(),
                ]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(1, $package->novaTools);
        $this->assertInstanceOf(DemoNovaResource::class, $package->novaTools[0]);
    }

    /** @test */
    public function blade_components_are_merged()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasBladeComponents(['x-abc' => TestBladeComponent::class])
                ->hasBladeComponents(['x-def' => TestBladeComponent::class])
                ->hasBladeComponents(['x-abc' => TestBladeComponent::class]);
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(2, $package->bladeComponents);
        $this->assertEquals([
            'x-abc' => TestBladeComponent::class,
            'x-def' => TestBladeComponent::class,
        ], $package->bladeComponents);
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

    public function api_routes_registered_if_enabled()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasApiRoute('abc')
                ->hasApiRoutes(['def', 'ghi']);
        });

        $package = $provider->register()->getPackage();
        $this->assertEquals(['abc', 'def', 'ghi'], $package->routeFileNames);
    }

    public function api_routes_not_registered_if_disabled()
    {
        config('tipoff.api.enabled', false);
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasApiRoute('abc')
                ->hasApiRoutes(['def', 'ghi']);
        });

        $package = $provider->register()->getPackage();
        $this->assertEquals([], $package->routeFileNames);
    }

    public function web_routes_registered_if_enabled()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasWebRoute('abc')
                ->hasWebRoutes(['def', 'ghi']);
        });

        $package = $provider->register()->getPackage();
        $this->assertEquals(['abc', 'def', 'ghi'], $package->routeFileNames);
    }

    public function web_routes_not_registered_if_disabled()
    {
        config('tipoff.web.enabled', false);
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasWebRoute('abc')
                ->hasWebRoutes(['def', 'ghi']);
        });

        $package = $provider->register()->getPackage();
        $this->assertEquals([], $package->routeFileNames);
    }

    /** @test */
    public function data_migrations_with_no_path_specified()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasDataMigrations();
        });

        $package = $provider->register()->getPackage();
        $this->assertCount(1, $package->dataMigrationPaths);
        $this->assertStringEndsWith('database/datamigrations', $package->dataMigrationPaths[0]);
    }

    /** @test */
    public function data_migrations_with_path_specified()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasDataMigrations('a', 'b', 'c');
        });

        $package = $provider->register()->getPackage();
        $this->assertEquals(['a', 'b', 'c'], $package->dataMigrationPaths);
    }

    /** @test */
    public function data_migrations_not_loaded_in_testing_env()
    {
        $provider = new TestServiceProvider($this->app, function (TipoffPackage $package) {
            $package
                ->hasDataMigrations();
        });

        $provider->register()->boot();
        $migrator = $this->app->make('migrator');
        $first = collect($migrator->paths())->first(function ($path) {
            return Str::endsWith($path, 'datamigrations');
        });
        $this->assertNull($first);
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

class TestBladeComponent extends Component
{
    public function render()
    {
        return '';
    }
}
