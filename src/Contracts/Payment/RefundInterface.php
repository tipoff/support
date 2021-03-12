<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Refund;

use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Payment\PaymentInterface;

interface RefundInterface extends BaseModelInterface
{
    public static function createRefund(PaymentInterface $payment, int $amount): self;

    public static function amountRefunded(PaymentInterface $payment): int;
}
