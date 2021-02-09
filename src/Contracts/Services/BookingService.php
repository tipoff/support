<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\BookingInterface;
use Tipoff\Support\Contracts\Models\SlotInterface;

interface BookingService extends BaseService
{
    public function getBookingInterface(?int $id): BookingInterface;

    public function resolveSlot(string $slotNumber, bool $persist = false): SlotInterface;

    public function createBooking(array $attributes): BookingInterface;
}
