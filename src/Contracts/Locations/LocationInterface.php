<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Locations;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Fees\FeeInterface;
use Tipoff\Support\Contracts\Taxes\TaxInterface;

interface LocationInterface extends BaseModelInterface
{
    public function getBookingTax(): ?TaxInterface;

    public function getBookingFee(): ?FeeInterface;

    public function getTimezone(): string;
}
