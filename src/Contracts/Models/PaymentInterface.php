<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface PaymentInterface extends BaseModelInterface
{
    public function getCustomer(): ?CustomerInterface;

    public function setOrder(OrderInterface $order);
}
