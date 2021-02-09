<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Brick\Money\Money;
use Carbon\Carbon;
use Tipoff\Support\Contracts\Models\CartInterface;
use Tipoff\Support\Contracts\Models\DiscountInterface;
use Tipoff\Support\Enums\AppliesTo;

interface DiscountService extends BaseService
{
    public function getDiscount(int $id): ?DiscountInterface;

    public function createAmountDiscount(string $name, string $code, Money $amount, AppliesTo $appliesTo, Carbon $expiresAt, int $creatorId);

    public function createPercentDiscount(string $name, string $code, float $percent, AppliesTo $appliesTo, Carbon $expiresAt, int $creatorId);

    public function applyCodeToCart(CartInterface $cart, string $code): bool;

    public function calculateDiscountDeductions(CartInterface $cart): Money;
}
