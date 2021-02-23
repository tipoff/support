<?php

declare(strict_types=1);

namespace Tipoff\Support\Events\Checkout;

use Tipoff\Support\Contracts\Checkout\CartInterface;

class CartUpdated
{
    public CartInterface $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }
}
