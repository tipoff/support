<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Illuminate\Support\Collection;
use Tipoff\Support\Contracts\Sellable\Sellable;

interface OrderInterface extends BaseItemContainerInterface
{
    /**
     * Finds an existing cart item be Sellable type and Sellable defined item it.  Null is returned
     * if item is not found;
     *
     * @param Sellable $sellable
     * @param string $itemId
     * @return OrderItemInterface|null
     */
    public function findItem(Sellable $sellable, string $itemId): ?OrderItemInterface;

    /**
     * Return a collection of objects implementing OrderItemInterface
     */
    public function getOrderItems(): Collection;
}
