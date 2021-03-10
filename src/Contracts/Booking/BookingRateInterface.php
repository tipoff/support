<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

use Tipoff\Support\Contracts\Scheduler\SlotInterface;

interface BookingRateInterface extends SlotInterface
{
    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get slug used in urls.
     *
     * @return string
     */
    public function getSlug(): string;

    /**
     * Get amount in cents.
     *
     * @return int
     */
    public function getAmount(): int;

    /**
     * Get number of participants for the rate.
     *
     * @return int|null
     */
    public function getParticipantsLimit(): ?int;
}
