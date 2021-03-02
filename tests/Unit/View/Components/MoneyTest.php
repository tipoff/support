<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\View\Components;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Tipoff\Support\Tests\TestCase;

class MoneyTest extends TestCase
{
    use InteractsWithViews;

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
}
