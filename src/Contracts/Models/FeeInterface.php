<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface FeeInterface extends BaseModelInterface
{
    public function generateTotalFeesByCartItem(CartItemInterface $cartItem): int;
}
