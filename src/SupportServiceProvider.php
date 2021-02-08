<?php

namespace Tipoff\Support;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Support\Commands\SupportCommand;

class SupportServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('support')
            ->hasConfigFile('tipoff')
            ->hasCommand(SupportCommand::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerModelsAliases();
        $this->registerNovaModelsAliases();
    }

    /**
     * Add model aliases to service conainer.
     *
     * @return void
     */
    public function registerModelsAliases(): void
    {
        foreach (config('tipoff.model_class') as $alias => $class) {
            if (empty($aliases[$alias])) {
                $this->app->alias($class, $alias);
            }
        }
    }

    /**
     * Add nova model aliases to service conainer.
     *
     * @return void
     */
    public function registerNovaModelsAliases(): void
    {
        foreach (config('tipoff.nova_class') as $alias => $class) {
            if (empty($aliases[$alias])) {
                $this->app->alias($class, 'nova.' . $alias);
            }
        }
    }
}
