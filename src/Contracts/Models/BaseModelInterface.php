<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface BaseModelInterface
{
    /**
     * Using docblock typehints to allow implementing classes freedom
     * to include docblock with class specific type
     *
     * @return self
     */
    public static function find(int $id);

    /**
     * @return self
     */
    public static function findOrFail(int $id);

    public function getId(): ?int;
}
