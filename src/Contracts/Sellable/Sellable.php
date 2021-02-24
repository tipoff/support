<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Sellable;

interface Sellable
{
    public function getDescription(): string;

    public function getMorphClass(): string;
}
