<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\Sellable\Sellable;

interface OrderItemInterface extends BaseItemInterface
{
    /**
     * Get order containing this order item
     */
    public function getOrder(): ?OrderInterface;
}
