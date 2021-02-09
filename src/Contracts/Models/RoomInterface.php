<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface RoomInterface extends BaseModelInterface
{
    public function hasInRoomMonitors(): bool;

    public function getLocation(): ?LocationInterface;
}
