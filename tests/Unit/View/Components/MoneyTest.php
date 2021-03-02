<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\View\Components;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Illuminate\Testing\TestView;
use Tipoff\Support\Tests\TestCase;

class MoneyTest extends TestCase
{
    use InteractsWithViews;

    protected function blade(string $template, array $data = [])
    {
        $tempDirectory = sys_get_temp_dir();

        if (! in_array($tempDirectory, ViewFacade::getFinder()->getPaths())) {
            ViewFacade::addLocation(sys_get_temp_dir());
        }

        $tempFile = tempnam($tempDirectory, 'laravel-blade').'.blade.php';

        // Attempt fix for ci/cd on windows
        $tempFile = preg_replace('/\.tmp\.blade/', '.blade', $tempFile);

        file_put_contents($tempFile, $template);

        return new TestView(view(Str::before(basename($tempFile), '.blade.php'), $data));
    }

    /** @test */
    public function formats_money()
    {
        $view = $this->blade(
            '<x-tipoff-money :amount="$amount" />',
            ['amount' => 1000]
        );

        $view->assertSee('$10.00');
    }

    /** @test */
    public function handles_null()
    {
        $view = $this->blade(
            '<x-tipoff-money/>',
        );

        $view->assertSee('$0.00');
    }

    /** @test */
    public function includes_label()
    {
        $view = $this->blade(
            '<x-tipoff-money :amount="$amount" :label="$label"/>',
            ['amount' => 1000, 'label' => 'Total']
        );

        $view->assertSee('Total: $10.00');
    }
}
