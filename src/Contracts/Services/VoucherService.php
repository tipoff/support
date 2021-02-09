<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Brick\Money\Money;
use Tipoff\Support\Contracts\Models\CartInterface;
use Tipoff\Support\Contracts\Models\VoucherInterface;

interface VoucherService extends BaseService
{
    public function getVoucher(int $id): ?VoucherInterface;

    public function generateVoucherCode(): string;

    public function applyCodeToCart(CartInterface $cart, string $code): bool;

    public function issuePartialRedemptionVoucher(CartInterface $cart, int $amount): int;

    public function markVouchersAsUsed(CartInterface $cart, int $orderId);

    public function calculateVoucherDeductions(CartInterface $cart): Money;
}
