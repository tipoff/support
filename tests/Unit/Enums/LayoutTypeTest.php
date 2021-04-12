<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Enums;

use \Tipoff\Support\Enums\LayoutType;
use Tipoff\Support\Tests\TestCase;

class LayoutTypeTest extends TestCase
{
    /** @test */
    public function can_get_array_of_options()
    {
        $options = LayoutType::optionsArray();
        $this->assertIsArray($options);
    }
}
