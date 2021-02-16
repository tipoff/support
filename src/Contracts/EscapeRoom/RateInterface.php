<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\EscapeRoom;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Checkout\CartItemTotal;

interface RateInterface extends BaseModelInterface, CartItemTotal
{
}
