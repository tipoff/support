<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Casts;

use Illuminate\Database\Eloquent\Model;
use Tipoff\Support\Objects\DiscountableValue;
use Tipoff\Support\Tests\TestCase;

class DiscountableValueTest extends TestCase
{
    /** @test */
    public function convert_with_value_only()
    {
        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->get(new class extends Model {
        }, 'attribute', 1000, []);

        $this->assertInstanceOf(DiscountableValue::class, $value);
        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(0, $value->getDiscounts());
        $this->assertEquals(1000, $value->getDiscountedAmount());
    }

    /** @test */
    public function convert_with_excess_discount()
    {
        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->get(new class extends Model {
        }, 'attribute', null, [
            'attribute' => 200,
            'attribute_discounts' => 1000,
        ]);

        $this->assertInstanceOf(DiscountableValue::class, $value);
        $this->assertEquals(200, $value->getOriginalAmount());
        $this->assertEquals(200, $value->getDiscounts());
        $this->assertEquals(0, $value->getDiscountedAmount());
    }

    /** @test */
    public function convert_with_value_and_discount()
    {
        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->get(new class extends Model {
        }, 'attribute', null, [
            'attribute' => 1000,
            'attribute_discounts' => 200,
        ]);

        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(200, $value->getDiscounts());
        $this->assertEquals(800, $value->getDiscountedAmount());
    }

    /** @test */
    public function convert_with_nulls()
    {
        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->get(new class extends Model {
        }, 'attribute', null, [
        ]);

        $this->assertEquals(0, $value->getOriginalAmount());
        $this->assertEquals(0, $value->getDiscounts());
        $this->assertEquals(0, $value->getDiscountedAmount());
    }

    /** @test */
    public function set_by_int()
    {
        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->set(new class extends Model {
        }, 'attribute', 100, []);

        $this->assertEquals([
            'attribute' => 100,
            'attribute_discounts' => 0,
        ], $value);
    }

    /** @test */
    public function set_by_null()
    {
        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->set(new class extends Model {
        }, 'attribute', null, []);

        $this->assertEquals([
            'attribute' => 0,
            'attribute_discounts' => 0,
        ], $value);
    }

    /** @test */
    public function set_by_object()
    {
        $value = (new DiscountableValue(1000))
            ->addDiscounts(200);

        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $value = $cast->set(new class extends Model {
        }, 'attribute', $value, []);

        $this->assertEquals([
            'attribute' => 1000,
            'attribute_discounts' => 200,
        ], $value);
    }

    /** @test */
    public function set_by_non_money_fails()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('DiscountableValue class expected');

        $cast = new \Tipoff\Support\Casts\DiscountableValue();
        $cast->set(new class extends Model {
        }, 'attribute', 'NotValid', []);
    }
}
