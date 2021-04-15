<?php

declare(strict_types=1);

namespace Tipoff\Support\Tests\Unit\Enums;

use Tipoff\Support\Enums\AppliesTo;
use Tipoff\Support\Tests\TestCase;

class AppliesToTest extends TestCase
{
    /** @test */
    public function can_get_array_of_options()
    {
        $options = AppliesTo::optionsArray();
        $this->assertIsArray($options);
    }
}
