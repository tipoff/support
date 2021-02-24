<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Objects;

use Tipoff\Support\Objects\DiscountableValue;
use Tipoff\Support\Tests\TestCase;

class DiscountableValueTest extends TestCase
{
    /** @test */
    public function construct_with_value()
    {
        $value = new DiscountableValue(1000);

        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(0, $value->getDiscounts());
        $this->assertEquals(1000, $value->getDiscountedAmount());
    }

    /** @test */
    public function add_discounts()
    {
        $value = (new DiscountableValue(1000))
            ->addDiscounts(200);

        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(200, $value->getDiscounts());
        $this->assertEquals(800, $value->getDiscountedAmount());
    }

    /** @test */
    public function reset()
    {
        $value = (new DiscountableValue(1000))
            ->addDiscounts(200);

        $result = $value->reset();
        $this->assertEquals(1000, $result->getOriginalAmount());
        $this->assertEquals(0, $result->getDiscounts());
        $this->assertEquals(1000, $result->getDiscountedAmount());

        // Value should be unchanged
        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(200, $value->getDiscounts());
        $this->assertEquals(800, $value->getDiscountedAmount());
    }

    /** @test */
    public function is_equal()
    {
        $value1 = (new DiscountableValue(1000))
            ->addDiscounts(200);

        $value2 = (new DiscountableValue(1000))
            ->addDiscounts(200);

        $value3 = (new DiscountableValue(1001))
            ->addDiscounts(200);

        $this->assertTrue($value1->isEqual($value2));
        $this->assertFalse($value1->isEqual($value3));
        $this->assertFalse($value1->isEqual(new DiscountableValue(1000)));
    }

    /** @test */
    public function add_multiple_discounts()
    {
        $value = (new DiscountableValue(1000))
            ->addDiscounts(300)
            ->addDiscounts(300)
            ->addDiscounts(300);

        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(900, $value->getDiscounts());
        $this->assertEquals(100, $value->getDiscountedAmount());

        $result = $value->addDiscounts(300);
        $this->assertEquals(1000, $result->getOriginalAmount());
        $this->assertEquals(1000, $result->getDiscounts());
        $this->assertEquals(0, $result->getDiscountedAmount());

        // Value should be unchanged
        $this->assertEquals(1000, $value->getOriginalAmount());
        $this->assertEquals(900, $value->getDiscounts());
        $this->assertEquals(100, $value->getDiscountedAmount());
    }

    /** @test */
    public function add_discountable_value()
    {
        $value1 = (new DiscountableValue(1000))
            ->addDiscounts(300);

        $value2 = (new DiscountableValue(500))
            ->addDiscounts(100);

        $result = $value1->add($value2);
        $this->assertEquals(1500, $result->getOriginalAmount());
        $this->assertEquals(400, $result->getDiscounts());
        $this->assertEquals(1100, $result->getDiscountedAmount());

        // Value 1 unchanged
        $this->assertEquals(1000, $value1->getOriginalAmount());
        $this->assertEquals(300, $value1->getDiscounts());
        $this->assertEquals(700, $value1->getDiscountedAmount());

        // Value 2 unchanged
        $this->assertEquals(500, $value2->getOriginalAmount());
        $this->assertEquals(100, $value2->getDiscounts());
        $this->assertEquals(400, $value2->getDiscountedAmount());
    }
}
