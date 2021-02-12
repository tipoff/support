<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

interface BaseModelInterface
{
    /**
     * Using docblock typehints to allow implementing classes freedom
     * to include docblock with class specific type
     *
     * @param mixed $id
     * @return self|null
     */
    public static function find($id);

    /**
     * @param mixed $id
     * @return self
     */
    public static function findOrFail($id);

    /**
     * @return mixed|null
     */
    public function getId();
}
