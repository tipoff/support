<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Objects\DiscountableValue;

interface BaseItemContainerInterface extends BaseModelInterface
{
    /**
     * Returns the DiscountableValue representing the total item amount / total item amount discounts
     */
    public function getItemAmount(): DiscountableValue;

    /**
     * Returns tax in cents.
     */
    public function getTax(): int;

    /**
     * Get methods for discountable shipping fee.
     */
    public function getShipping(): DiscountableValue;

    /**
     * Get methods for order level discounts.
     */
    public function getCartDiscounts(): int;

    /**
     * Get methods for order level credits applied.
     */
    public function getCartCredits(): int;

    /**
     * Get unique location established for order via its items (if any)
     */
    public function getLocationId(): ?int;
}
