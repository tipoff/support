<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Casts;

use Illuminate\Database\Eloquent\Model;
use MabeEnum\Enum;
use Tipoff\Support\Tests\TestCase;

class EnumTest extends TestCase
{
    /** @test */
    public function get_valid_value_converts_to_enum()
    {
        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $value = $cast->get(new class extends Model {
        }, 'attribute', TestEnum::TEST_VALUE, []);

        $this->assertInstanceOf(Enum::class, $value);
        $this->assertTrue($value->is(TestEnum::TEST_VALUE()));
    }

    /** @test */
    public function get_invalid_value_fails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unknown value \'bad_value\' for enumeration Tipoff\Support\Tests\Unit\Casts\TestEnum');

        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $cast->get(new class extends Model {
        }, 'attribute', 'bad_value', []);
    }

    /** @test */
    public function set_by_enum_converts_to_string()
    {
        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $value = $cast->set(new class extends Model {
        }, 'attribute', TestEnum::TEST_VALUE(), []);

        $this->assertIsString($value);
        $this->assertEquals(TestEnum::TEST_VALUE, $value);
    }

    /** @test */
    public function set_by_string()
    {
        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $value = $cast->set(new class extends Model {
        }, 'attribute', 'test_value', []);

        $this->assertIsString($value);
        $this->assertEquals(TestEnum::TEST_VALUE, $value);
    }

    /** @test */
    public function set_by_null_returns_null()
    {
        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $value = $cast->set(new class extends Model {
        }, 'attribute', null, []);

        $this->assertEquals(null, $value);
    }

    /** @test */
    public function set_by_unknown_string_fails()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unknown value \'bad_value\' for enumeration Tipoff\Support\Tests\Unit\Casts\TestEnum');

        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $cast->set(new class extends Model {
        }, 'attribute', 'bad_value', []);
    }

    /** @test */
    public function set_by_non_enum_fails()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Enum class expected');

        $cast = new \Tipoff\Support\Casts\Enum(TestEnum::class);
        $cast->set(new class extends Model {
        }, 'attribute', 123, []);
    }
}

/**
 * @method static TestEnum TEST_VALUE()
 */
class TestEnum extends Enum
{
    const TEST_VALUE = 'test_value';
}
