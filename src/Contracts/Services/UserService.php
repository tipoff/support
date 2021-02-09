<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\UserInterface;

interface UserService extends BaseService
{
    public function getUser(?int $id): ?UserInterface;
}
