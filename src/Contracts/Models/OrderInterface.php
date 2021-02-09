<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface OrderInterface extends BaseModelInterface
{
    public function getCustomer(): ?CustomerInterface;

    public function getLocation(): ?LocationInterface;

    public function getPartialRedemptionVoucher(): ?VoucherInterface;
}
