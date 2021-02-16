<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Scheduling;

use Carbon\Carbon;
use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\EscapeRoom\RateInterface;
use Tipoff\Support\Contracts\EscapeRoom\RoomInterface;
use Tipoff\Support\Contracts\Fees\FeeInterface;
use Tipoff\Support\Contracts\Taxes\TaxInterface;

interface SlotInterface extends BaseModelInterface
{
    public static function resolveSlot(string $slotNumber): SlotInterface;

    public function setHold(int $userId, ?Carbon $expiresAt = null): SlotInterface;

    public function releaseHold(): SlotInterface;

    public function getHold(): ?object;

    public function getStartAt(): ?Carbon;

    public function getFormattedStartAt(): ?string;

    public function getRoom(): ?RoomInterface;

    public function getFee(): ?FeeInterface;

    public function getRate(): ?RateInterface;

    public function getTax(): ?TaxInterface;
}
