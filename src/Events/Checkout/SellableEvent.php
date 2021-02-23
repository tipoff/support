<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Illuminate\Foundation\Events\Dispatchable;
use Tipoff\Support\Contracts\Sellable\Sellable;

abstract class SellableEvent
{
    use Dispatchable;

    public Sellable $sellable;

    public function __construct(Sellable $sellable)
    {
        $this->sellable = $sellable;
    }

    public function isA(string $class)
    {
        return get_class($this->sellable) === $class;
    }
}
