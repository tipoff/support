<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payment;

use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface RefundInterface extends BaseModelInterface
{
    public static function createRefund(PaymentInterface $payment, int $amount): self;

    public function getPayment(): PaymentInterface;
}
