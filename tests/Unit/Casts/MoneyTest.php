<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Casts;

use Brick\Money\Money;
use Illuminate\Database\Eloquent\Model;
use MabeEnum\Enum;
use Tipoff\Support\Tests\TestCase;

class MoneyTest extends TestCase
{
    /** @test */
    public function get_value_converts_to_money()
    {
        $cast = new \Tipoff\Support\Casts\Money();
        $value = $cast->get(new class extends Model {}, 'attribute', 1000, []);

        $this->assertInstanceOf(Money::class, $value);
        $this->assertEquals('$10.00', $value->formatTo('en-US'));
    }

    /** @test */
    public function set_by_money_converts_to_int()
    {
        $cast = new \Tipoff\Support\Casts\Money();
        $value = $cast->set(new class extends Model {}, 'attribute', Money::ofMinor(1000, 'USD'), []);

        $this->assertIsInt($value);
        $this->assertEquals(1000, $value);
    }

    /** @test */
    public function set_by_non_money_fails()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Money class expected');

        $cast = new \Tipoff\Support\Casts\Money();
        $cast->set(new class extends Model {}, 'attribute', 'NotMoney', []);
    }
}
