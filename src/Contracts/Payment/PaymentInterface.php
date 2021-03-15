<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payment;

use Tipoff\Support\Contracts\Checkout\OrderInterface;
use Tipoff\Support\Contracts\Models\BaseModelInterface;
use Tipoff\Support\Contracts\Models\UserInterface;

interface PaymentInterface extends BaseModelInterface
{
    public static function createPayment(int $locationId, $chargeable, int $amount, $paymentMethod): self;

    public function attachOrder(OrderInterface $order): self;

    public function getOrder(): OrderInterface;

    public function getLocationId(): int;
}
