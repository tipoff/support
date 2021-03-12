<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Filters;

use Illuminate\Support\Collection;

interface BaseFilter
{
    public function apply(): Collection;
}
