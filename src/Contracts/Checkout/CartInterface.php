<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Tipoff\Support\Contracts\BaseModelInterface;

interface CartInterface extends BaseModelInterface
{
    public static function activeCart(int $userId): CartInterface;

    public function applyDeductionCode(string $code): CartInterface;

    public function getTotalParticipants(): int;

    /**
     * @return array|CartItemInterface[]
     */
    public function getCartItems(): array;
}
