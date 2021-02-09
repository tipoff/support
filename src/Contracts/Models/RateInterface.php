<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface RateInterface extends BaseModelInterface
{
    public function getAmount(int $participants, bool $isPrivate): int;
}
