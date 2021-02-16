<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Brick\Money\Money;
use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\EscapeRoom\RateInterface;
use Tipoff\Support\Contracts\Fees\FeeInterface;
use Tipoff\Support\Contracts\Taxes\TaxInterface;

interface CartItemInterface extends BaseModelInterface
{
    public function getSlotNumber(): ?string;

    public function getIsPrivate(): bool;

    public function getParticipants(): int;

    public function getAmount(): Money;

    public function getTotalFees(): Money;

    public function getTotalDeductions(): Money;

    public function getFee(): ?FeeInterface;

    public function getRate(): ?RateInterface;

    public function getTax(): ?TaxInterface;
}
