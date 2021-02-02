<?php

declare(strict_types=1);

namespace Tipoff\Support\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Money implements CastsAttributes
{
    /** @var string */
    private $currency;

    public function __construct(string $currency = 'USD')
    {
        $this->currency = $currency;
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return \Brick\Money\Money::ofMinor($value, $this->currency);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof \Brick\Money\Money) {
            return $value->getUnscaledAmount()->toInt();
        }

        throw new \InvalidArgumentException('Money class expected');
    }
}
