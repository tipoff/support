<?php

namespace Tipoff\Support;

use Illuminate\Support\Facades\Blade;

class SupportServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('support')
            ->hasConfigFile('tipoff');
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        Blade::directive('tipoffMoney', function ($amount) {
            return "<?php echo '$' . number_format((int) ($amount ?? 0) / 100, 2); ?>";
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
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
            $this->app->alias($class, $alias);
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
            $this->app->alias($class, 'nova.' . $alias);
        }
    }
}
