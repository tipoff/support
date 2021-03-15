<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payment;

use Tipoff\Support\Contracts\Checkout\OrderInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface PaymentInterface extends BaseModelInterface
{
    public static function createPayment(int $locationId, $chargeable, int $amount, $paymentMethod, string $source): self;

    public function attachOrder(OrderInterface $order): self;

    public function getOrder(): OrderInterface;

    public function getLocationId(): int;
}
