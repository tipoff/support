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

    /**
     * Set instance of Sellable associated w/this order item.  Set allows a change in
     * the sellable association during order item creation from cart item.
     */
    public function setSellable(Sellable $sellable): self;

    /**
     * Get parent item for a bundled order item.  For example, a booking fee
     * should have its parent set to the order item for the booking.  This
     * ensures related items are handled as a unit.
     */
    public function getParentItem(): ?OrderItemInterface;
}
