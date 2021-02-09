<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Services;

use Tipoff\Support\Contracts\Models\RoomInterface;

interface RoomService extends BaseService
{
    public function getRoom(int $id): RoomInterface;
}
