<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Sellable;

interface Sellable
{
    // For related, see Tipoff\Support\Events\Checkout

    public function getDescription(): string;
}
