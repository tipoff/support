<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Discounts;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Checkout\CartDeduction;

interface DiscountInterface extends BaseModelInterface, CartDeduction
{
}
