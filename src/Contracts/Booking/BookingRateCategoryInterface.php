<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

interface BookingRateCategoryInterface
{
    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get label used in lists.
     *
     * @return string
     */
    public function getLabel(): string;

    /**
     * Get rates inside category.
     *
     * @return Relation
     */
    public function rates(): Relation;
}
