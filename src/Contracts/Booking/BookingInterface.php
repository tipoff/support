<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tipoff\Support\Contracts\Booking\BookingSlotInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface BookingInterface extends BaseModelInterface
{
    /**
     * Get timezone.
     *
     * @return string
     */
    public function getTimezone(): string;

    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get booking description used in details.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get booking date.
     *
     * @return Carbon
     */
    public function getDate(): Carbon;

    /**
     * Get slot.
     *
     * @return Slot|null
     */
    public function getSlot(): BookingSlotInterface;

    /**
     * Get amount in cents.
     *
     * @return int
     */
    public function getAmount(): int;

    /**
     * Get amount in cents.
     *
     * @return int
     */
    public function participants(): BelongsToMany;

}
