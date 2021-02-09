<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface TaxInterface extends BaseModelInterface
{
    public function generateTotalTaxesByCartItem(CartItemInterface $cartItem): int;
}
