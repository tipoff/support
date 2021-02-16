<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\EscapeRoom;

use Tipoff\Support\Contracts\BaseModelInterface;
use Tipoff\Support\Contracts\Locations\LocationInterface;

interface RoomInterface extends BaseModelInterface
{
    public function getLocation(): ?LocationInterface;

    public function getRate(): ?RateInterface;

    public function getSupervision(): ?SupervisionInterface;

    public function getTheme(): ?ThemeInterface;

    public function getParticipants(): int;
}
