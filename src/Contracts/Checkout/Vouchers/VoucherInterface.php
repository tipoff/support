<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Vouchers;

use Tipoff\Support\Contracts\Checkout\CodedCartAdjustment;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Models\UserInterface;

interface VoucherInterface extends BaseModelInterface, CodedCartAdjustment
{
    public static function createRefundVoucher(int $locationId, UserInterface $user, int $amount): self;
}
