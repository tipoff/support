<?php

declare(strict_types=1);

namespace Tipoff\Support;

use Spatie\LaravelPackageTools\Package;

class TipoffPackage extends Package
{
    /**
     * [
     *   EventClass => [
     *      HandlerClass,
     *      // ...
     *      ],
     *   // ...
     * ]
     */
    public array $events = [];

    /**
     * [
     *   ModelClass => PolicyClass,
     *   // ...
     * ]
     */
    public array $policies = [];

    /**
     * [
     *   ModelInterface => ModelClass,
     *   // ...
     * ]
     */
    public array $modelInterfaces = [];

    /**
     * [
     *   ServiceInterface => ServiceImplementation,
     *   // ...
     * ]
     */
    public array $services = [];

    /**
     * [
     *   NovaResource::class,
     *   // ...
     * ]
     */
    public array $novaResources = [];

    /**
     * [
     *   new NovaTool(...),
     *   // ...
     * ]
     */
    public array $novaTools = [];

    /**
     * [
     *   'tag-name' => ComponentClass,
     *   // ...
     * ]
     */
    public array $bladeComponents = [];

    public array $bindings = [];

    /**
     * [
     *    '/path/to/seeder/migration/files',
     *    // ..
     * ]
     */
    public array $dataMigrationPaths = [];

    public function __construct(Package $package)
    {
        $this->setBasePath($package->basePath);
    }

    public function hasRoute(string $routeFileName): Package
    {
        throw new \Exception('Use hasApiRoute or hasWebRoute for Tipoff routes');
    }

    public function hasRoutes(...$routeFileNames): Package
    {
        throw new \Exception('Use hasApiRoutes or hasWebRoutes for Tipoff routes');
    }

    public function hasApiRoute(string $routeFileName): Package
    {
        if (config('tipoff.api.enabled')) {
            return parent::hasRoute($routeFileName);
        }

        return $this;
    }

    public function hasApiRoutes(...$routeFileNames): Package
    {
        if (config('tipoff.api.enabled')) {
            return parent::hasRoutes(...$routeFileNames);
        }

        return $this;
    }

    public function hasWebRoute(string $routeFileName): Package
    {
        if (config('tipoff.web.enabled')) {
            return parent::hasRoute($routeFileName);
        }

        return $this;
    }

    public function hasWebRoutes(...$routeFileNames): Package
    {
        if (config('tipoff.web.enabled')) {
            return parent::hasRoutes(...$routeFileNames);
        }

        return $this;
    }

    public function hasPolicies(array $policies): self
    {
        $this->policies = array_merge($this->policies, $policies);

        return $this;
    }

    public function hasEvents(array $events): self
    {
        foreach ($events as $event => $listeners) {
            $this->events[$event] = array_values(
                array_unique(
                    array_merge($this->events[$event] ?? [], $listeners)
                )
            );
        }

        return $this;
    }

    public function hasModelInterfaces(array $modelInterfaces): self
    {
        $this->modelInterfaces = array_merge($this->modelInterfaces, $modelInterfaces);

        return $this;
    }

    public function hasServices(array $services): self
    {
        $this->services = array_merge($this->services, $services);

        return $this;
    }

    public function hasNovaResources(array $novaResources): self
    {
        $this->novaResources = array_values(
            array_unique(
                array_merge($this->novaResources, $novaResources)
            )
        );

        return $this;
    }

    public function hasNovaTools(array $novaTools): self
    {
        $this->novaTools = array_merge($this->novaTools, $novaTools);

        return $this;
    }

    public function hasBladeComponents(array $bladeComponents): self
    {
        $this->bladeComponents = array_merge($this->bladeComponents, $bladeComponents);

        return $this;
    }

    public function hasBindings(array $bindings): self
    {
        $this->bindings = array_merge($this->bindings, $bindings);

        return $this;
    }

    public function hasDataMigrations(...$dataMigrationPaths): self
    {
        $this->dataMigrationPaths = array_unique(
            array_merge($this->dataMigrationPaths, $dataMigrationPaths ?: [ $this->basePath.'/../database/datamigrations' ])
        );

        return $this;
    }
}
