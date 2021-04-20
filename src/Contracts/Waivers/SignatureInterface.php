<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Waivers;

use Carbon\Carbon;
use Tipoff\Support\Contracts\Authorization\EmailAddressInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface SignatureInterface extends BaseModelInterface
{
    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName(): string;

    /**
     * Get email address.
     *
     * @return EmailAddressInterface
     */
    public function getEmailAddress(): EmailAddressInterface;

    /**
     * Get email address.
     *
     * @return Carbon
     */
    public function getDob(): Carbon;
}
