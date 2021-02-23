<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Carbon\Carbon;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Sellable\Sellable;
use Tipoff\Support\Objects\DiscountableValue;

interface CartItemInterface extends BaseModelInterface
{
    /**
     * Get instance of Sellable associated w/this cart item
     */
    public function getSellable(): Sellable;

    /**
     * Set Sellable provided opaque item id
     */
    public function getItemId(): string;

    /**
     * Get/Set item quantity
     */
    public function getQuantity(): int;

    public function setQuantity(int $qty): self;

    /**
     * Get/Set user friendly description
     */
    public function getDescription(): string;

    public function setDescription(string $description): self;

    /**
     * Get/set discountable amount for this cart item
     *
     * @param DiscountableValue|int $amount
     * @return $this
     */
    public function setAmount($amount): self;

    public function getAmount(): DiscountableValue;

    /**
     * Get/set location for this cart item.  An exception is thrown if cart items
     * have different locations.
     */
    public function getLocationId(): ?int;

    public function setLocationId(?int $locationId): self;

    /**
     * Get/set tax code for this item
     */
    public function getTaxCode(): ?string;

    public function setTaxCode(?string $taxCode): self;

    /**
     * Get/set expiration for this item
     */
    public function getExpiresAt(): Carbon;

    public function setExpiresAt(Carbon $expiresAt): self;

    /**
     * Get/set parent item for a bundled cart item.  For example, a booking fee
     * should have its parent set to the cart item for the pending booking.  This
     * ensures related items are handled as a unit.
     */
    public function getParentItem(): ?CartItemInterface;

    public function setParentItem(?CartItemInterface $parent): self;

    /**
     * Get meta data by optional key.  Dot notion in key paths is supported via Arr::get(...)
     *
     * @param string|null $key
     * @param $default
     * @return mixed
     */
    public function getMetaData(?string $key, $default);

    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is given to the method, the entire array will be replaced.
     *
     * @param string|null $key
     * @param $value
     * @return $this
     */
    public function setMetaData(?string $key, $value): self;
}
