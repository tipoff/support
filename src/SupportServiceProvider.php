<?php

namespace Tipoff\Support;

use Illuminate\Foundation\AliasLoader;
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
        $loader = AliasLoader::getInstance();
        $aliases = $loader->getAliases();

        foreach (config('tipoff.model_class') as $alias => $class) {
            if (empty($aliases[$alias])) {
                $loader->alias($alias, $class);
            }
        }
    }
}
