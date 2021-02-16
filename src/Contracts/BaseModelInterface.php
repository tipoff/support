<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts;

interface BaseModelInterface
{
    /**
     * Using docblock typehints to allow implementing classes freedom
     * to include docblock with class specific type
     *
     * @param mixed $id
     * @return static|null
     */
    public static function find($id);

    /**
     * @param mixed $id
     * @return static
     */
    public static function findOrFail($id);

    /**
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes);

    /**
     * @return mixed|null
     */
    public function getId();

    /**
     * @param array $options
     * @return static
     */
    public function save(array $options = []);
}
