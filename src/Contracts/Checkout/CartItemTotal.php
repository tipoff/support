<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Brick\Money\Money;

interface CartItemTotal
{
    public function getTotalByCartItem(CartItemInterface $cartItem): Money;
}
