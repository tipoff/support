<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Taxes;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Checkout\CartItemTotal;

interface TaxInterface extends BaseModelInterface, CartItemTotal
{
}
