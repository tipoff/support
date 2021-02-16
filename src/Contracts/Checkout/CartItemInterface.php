<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout;

use Brick\Money\Money;
use Tipoff\Support\Contracts\BaseModelInterface;

interface CartItemInterface extends BaseModelInterface
{
    public function getSlotNumber(): ?string;

    public function getIsPrivate(): bool;

    public function getParticipants(): int;

    public function getAmount(): Money;

    public function getTotalFees(): Money;

    public function getTotalDeductions(): Money;

    // TODO - typehint return value to FeeInterface when available
    public function getFee();
}
