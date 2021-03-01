<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Determine if User owns this resource
     *
     * @param UserInterface $user
     * @return bool
     */
    public function isOwner(UserInterface $user): bool;

    /**
     * Scope results to only those that given user should have access to.
     *
     * @param Builder $query
     * @param UserInterface $user
     * @return Builder
     */
    public function scopeVisibleBy(Builder $query, UserInterface $user): Builder;
}
