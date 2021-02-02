<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Rules;

use MabeEnum\Enum;
use Tipoff\Support\Tests\TestCase;

class EnumTest extends TestCase
{
    /** @test */
    public function valid_value_passes()
    {
        $rule = new \Tipoff\Support\Rules\Enum(TestEnum::class);
        $this->assertTrue($rule->passes('attribute', TestEnum::TEST_VALUE));
    }

    /** @test */
    public function invalid_value_fails()
    {
        $rule = new \Tipoff\Support\Rules\Enum(TestEnum::class);
        $this->assertFalse($rule->passes('attribute', 'bad_value'));
    }

    /** @test */
    public function message_is_computed()
    {
        $rule = new \Tipoff\Support\Rules\Enum(TestEnum::class);
        $this->assertEquals('The :attribute is not a valid value for TestEnum.', $rule->message());
    }
}

/**
 * @method static TestEnum TEST_VALUE()
 */
class TestEnum extends Enum
{
    const TEST_VALUE = 'test_value';
}
