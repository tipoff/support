<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Fees;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Checkout\CartItemTotal;

interface FeeInterface extends BaseModelInterface, CartItemTotal
{
}
