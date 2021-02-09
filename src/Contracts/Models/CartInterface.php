<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface CartInterface extends BaseModelInterface
{
    public function getLocation(): ?LocationInterface;

    public function getUser(): ?UserInterface;

    public function getTotalParticipants(): int;
}
