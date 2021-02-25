<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

interface CodedCartAdjustment
{
    /**
     * Locates an active adjustment by its code.  Null if nothing found.
     *
     * @param string $code
     * @return static|null
     */
    public static function findByCode(string $code);

    public static function calculateAdjustments(CartInterface $cart): void;

    /**
     * @param CartInterface $cart
     * @return array|string[]
     */
    public static function getCodesForCart(CartInterface $cart): array;

    /**
     * Associates adjustment with cart
     *
     * @param CartInterface $cart
     * @return static
     */
    public function applyToCart(CartInterface $cart);

    /**
     * Removes adjustment from cart
     *
     * @param CartInterface $cart
     * @return static
     */
    public function removeFromCart(CartInterface $cart);
}
