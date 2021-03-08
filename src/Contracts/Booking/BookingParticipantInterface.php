<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Booking;

use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Models\UserInterface;

interface BookingParticipantInterface extends BaseModelInterface
{
	/**
	 * Get label used in lists.
	 *
	 * @return string
	 */
    public function getLabel(): string;

	/**
	 * Get email.
	 *
	 * @return string
	 */
    public function getEmail(): string;

	/**
	 * Check is participant account verified.
	 *
	 * @return bool
	 */
    public function isVerified(): bool;

    /**
     * Returns the user that owns the container
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface;

}
