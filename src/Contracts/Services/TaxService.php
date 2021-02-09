<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\TaxInterface;

interface TaxService extends BaseService
{
    public function getTax(?int $id): ?TaxInterface;
}
