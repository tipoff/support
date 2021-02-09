<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\CartItemInterface;
use Tipoff\Support\Contracts\Models\FeeInterface;

interface FeeService extends BaseService
{
    public function getFee(?int $id): ?FeeInterface;
}
