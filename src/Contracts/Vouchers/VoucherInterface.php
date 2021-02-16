<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Vouchers;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Checkout\CartDeduction;

interface VoucherInterface extends BaseModelInterface, CartDeduction
{
    public static function generateVoucherCode(): string;

    public static function issuePartialRedemptionVoucher(CartInterface $cart, int $locationId, int $amount, int $userId): VoucherInterface;
}
