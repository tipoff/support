<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Illuminate\Support\Collection;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Sellable\Sellable;
use Tipoff\Support\Objects\DiscountableValue;

interface CartInterface extends BaseModelInterface
{
    /**
     * Retrieve or create the current active cart for the given user.
     *
     * @param int $userId
     * @return static
     */
    public static function activeCart(int $userId): self;

    /**
     * Adds or updates an item in the cart using Sellable supplied $itemId as unique identifier.
     * A CartItemCreated or CartItemUpdated event will be dispatched.  A Sellable may set additional
     * information in an event listener or the CartItemInterface API.
     *
     * @param string $itemId
     * @param Sellable $sellable
     * @param DiscountableValue|int $amount
     * @param int $qty
     * @return CartItemInterface
     */
    public function upsertItem(Sellable $sellable, string $itemId, $amount, int $qty = 1): CartItemInterface;

    /**
     * Remove an item from the cart by its Sellable defined item id.  If an item is removed, a CartItemRemoved
     * event is dispatched.
     *
     * @param Sellable $sellable
     * @param string $itemId
     * @return $this
     */
    public function removeItem(Sellable $sellable, string $itemId): self;

    /**
     * Returns the DiscountableValue representing the total item amount / total item amount discounts
     *
     * @return DiscountableValue
     */
    public function getItemAmount(): DiscountableValue;

    /**
     * Returns tax in cents.
     *
     * @return int
     */
    public function getTax(): int;

    /**
     * Get/Set methods for discountable shipping fee.
     *
     * @param DiscountableValue|int $value
     * @return $this
     */
    public function setShipping($value): self;

    public function getShipping(): DiscountableValue;

    /**
     * Get/set methods for cart level discounts.
     */
    public function getCartDiscounts(): int;

    public function addCartDiscounts(int $value): self;

    /**
     * Get/set methods for cart level credits pending redemption.
     */
    public function getCartCredits(): int;

    public function addCartCredits(int $value): self;

    /**
     * Applies a coded discount or coded voucher to the cart.  An exception is thrown
     * if the coded discount or voucher is not valid or not found.
     */
    public function applyCode(string $code): self;

    /**
     * Get unique location established for cart via its items (if any)
     */
    public function getLocationId(): ?int;

    /**
     * Return a collection of objects implementing CartItemInterface
     */
    public function getCartItems(): Collection;
}
