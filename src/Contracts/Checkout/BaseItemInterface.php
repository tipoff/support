<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Sellable\Sellable;
use Tipoff\Support\Objects\DiscountableValue;

interface BaseItemInterface extends BaseModelInterface
{
    /**
     * Get/set instance of Sellable associated w/this item.
     */
    public function getSellable(): Sellable;

    /**
     * Get Sellable provided opaque item id
     */
    public function getItemId(): string;

    /**
     * Get item quantity
     */
    public function getQuantity(): int;

    /**
     * Get user friendly description
     */
    public function getDescription(): string;

    /**
     * Get discountable amount for this order item
     */
    public function getAmount(): DiscountableValue;

    /**
     * Get tax charged for this order item
     */
    public function getTax(): int;

    /**
     * Get location for this order item.
     */
    public function getLocationId(): ?int;

    /**
     * Get tax code for this item
     */
    public function getTaxCode(): ?string;

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
