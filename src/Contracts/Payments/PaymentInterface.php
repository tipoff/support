<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Payments;

use Tipoff\Support\Contracts\Addresses\CustomerInterface;
use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Checkout\OrderInterface;

interface PaymentInterface extends BaseModelInterface
{
    public function getCustomer(): ?CustomerInterface;

    public function setOrder(OrderInterface $order): ?PaymentInterface;
}
