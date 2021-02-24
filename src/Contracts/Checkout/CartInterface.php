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
     * Creates a new, DETACHED, cart item with required information.  Use `upsertItem` to attach
     * the created item to a cart.
     *
     * @param string $itemId
     * @param Sellable $sellable
     * @param DiscountableValue|int $amount
     * @param int $quantity
     * @return CartItemInterface
     */
    public static function createItem(Sellable $sellable, string $itemId, $amount, int $quantity = 1): CartItemInterface;

    /**
     * Adds a newly created cart item to the cart or indicates an existing item has been changed. Item is validated as
     * part of the operation.  A CartItemCreated or CartItemUpdated event is dispatched depending on the actual
     * operation performed.
     *
     * @param CartItemInterface $cartItem
     * @return CartItemInterface
     */
    public function upsertItem(CartItemInterface $cartItem): CartItemInterface;

    /**
     * Finds an existing cart item be Sellable type and Sellable defined item it.  Null is returned
     * if item is not found;
     *
     * @param Sellable $sellable
     * @param string $itemId
     * @return CartItemInterface|null
     */
    public function findItem(Sellable $sellable, string $itemId): ?CartItemInterface;

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
     * Get/update methods for cart level credits pending redemption.
     */
    public function getCartCredits(): int;

    public function addCartCredits(int $value): self;

    /**
     * Applies a coded discount or coded voucher to the cart.  An exception is thrown
     * if the coded discount or voucher is not valid or not found.
     */
    public function applyCode(string $code): self;

    /**
     * Get/set unique location established for cart via its items (if any)
     */
    public function getLocationId(): ?int;

    public function setLocationId(?int $locationId): self;

    /**
     * Return a collection of objects implementing CartItemInterface
     */
    public function getCartItems(): Collection;
}
