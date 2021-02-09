<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface CartItemInterface extends BaseModelInterface
{
    public function getRate(): ?RateInterface;

    public function getFee(): ?FeeInterface;

    public function getRoom(): ?RoomInterface;

    public function getTax(): ?TaxInterface;
}
