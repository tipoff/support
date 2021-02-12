<?php

declare(strict_types=1);

namespace Tipoff\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use ReflectionClass;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

abstract class TipoffServiceProvider extends PackageServiceProvider
{
    abstract public function configureTipoffPackage(TipoffPackage $tipoffPackage): void;

    /**
     * Override required to inject TipoffPackage class as replacement
     * and then invoke new abstract for tipoff package configuration
     */
    public function configurePackage(Package $package): void
    {
        $this->package = new TipoffPackage($package);

        $this->configureTipoffPackage($this->package);
    }

    public function bootingPackage()
    {
        $this->loadMigrationsFrom($this->package->basePath.'/../database/migrations');
    }

    public function packageRegistered()
    {
        /** @var TipoffPackage $package */
        $package = $this->package;

        // Model interfaces
        foreach ($package->modelInterfaces as $interface => $implementation) {
            if (! (new ReflectionClass($implementation))->implementsInterface($interface)) {
                throw new \InvalidArgumentException("{$implementation} does not implement {$interface}");
            }
            $this->app->bind($interface, $implementation);
        }

        // Service interfaces
        foreach ($package->services as $interface => $implementation) {
            if (! (new ReflectionClass($implementation))->implementsInterface($interface)) {
                throw new \InvalidArgumentException("{$implementation} does not implement {$interface}");
            }
            $this->app->singleton($interface, $implementation);
        }

        // Policies
        foreach ($package->policies as $model => $policy) {
            if (! is_a($model, Model::class, true)) {
                throw new \InvalidArgumentException("{$model} is not a Model instance");
            }
            Gate::policy($model, $policy);
        }

        // Events
        foreach ($package->events as $event => $listeners) {
            foreach (array_unique($listeners) as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}