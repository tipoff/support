<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\CartItemInterface;
use Tipoff\Support\Contracts\Models\RateInterface;

interface RateService extends BaseService
{
    public function getRate(?int $id): ?RateInterface;

    public function getAmount(CartItemInterface $cartItem, int $participants, bool $isPrivate): int;
}
