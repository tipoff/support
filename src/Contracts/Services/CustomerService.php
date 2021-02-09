<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\CustomerInterface;

interface CustomerService extends BaseService
{
    public function getCustomer(?int $id): ?CustomerInterface;
}
