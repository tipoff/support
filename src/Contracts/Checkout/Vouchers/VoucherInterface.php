<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Checkout\Vouchers;

use Tipoff\Support\Contracts\Checkout\CodedCartAdjustment;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface VoucherInterface extends BaseModelInterface, CodedCartAdjustment
{
}
