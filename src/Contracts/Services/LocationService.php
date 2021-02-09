<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\LocationInterface;

interface LocationService extends BaseService
{
    public function getLocation(?int $id): ?LocationInterface;
}
