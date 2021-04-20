<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Feedback;

use Carbon\Carbon;
use Tipoff\Support\Contracts\Authorization\EmailAddressInterface;
use Tipoff\Support\Contracts\Booking\BookingParticipantInterface;
use Tipoff\Support\Contracts\Locations\LocationInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Waivers\SignatureInterface;

interface FeedbackInterface extends BaseModelInterface
{
    /**
     * Ensure feedback exists for signature/participant.
     *
     * @param SignatureInterface $signature
     * @return mixed
     */
    public static function createFromSignature(SignatureInterface $signature): self;
}
