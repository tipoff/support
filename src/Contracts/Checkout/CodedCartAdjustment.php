<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

interface CodedCartAdjustment
{
    public static function findByCode(string $code);

    public static function calculateAdjustments(CartInterface $cart);

    /**
     * @param CartInterface $cart
     * @return array|string[]
     */
    public static function getCodesForCart(CartInterface $cart): array;

    /**
     * Associates adjustment with cart
     */
    public function applyToCart(CartInterface $cart);

    /**
     * Removes adjustment from cart
     */
    public function removeFromCart(CartInterface $cart);
}
