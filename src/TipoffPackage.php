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

    public function __construct(Package $package)
    {
        $this->setBasePath($package->basePath);
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
}
