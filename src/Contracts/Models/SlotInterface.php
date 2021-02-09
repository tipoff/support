<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

use Carbon\Carbon;

interface SlotInterface extends BaseModelInterface
{
    public function getRoom(): ?RoomInterface;

    public function getRate(): ?RateInterface;

    public function getTax(): ?TaxInterface;

    public function getFee(): ?FeeInterface;

    public function setHold(int $userId, ?Carbon $expiresAt = null): void;

    public function releaseHold(): void;

    public function getHold(): ?object;

    public function hasHold(): bool;

    public function getStartAt(): Carbon;

    public function getFormattedStart(): string;
}
