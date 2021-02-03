<?php

declare(strict_types=1);

namespace Tipoff\Support\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @param  string  $related
     * @param  string|null  $foreignKey
     * @param  string|null  $ownerKey
     * @param  string|null  $relation
     * @psalm-suppress InvalidNullableReturnType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
        if (! class_exists($related)) {
            /** TODO - should this throw be an assertion instead?  Not sure how code will continue properly if this is hit */
            return;
        }

        return parent::belongsTo($related, $foreignKey, $ownerKey, $relation);
    }

    /**
     * Define a one-to-many relationship.
     *
     * @param  string  $related
     * @param  string|null  $foreignKey
     * @param  string|null  $localKey
     * @psalm-suppress InvalidNullableReturnType
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        if (! class_exists($related)) {
            /** TODO - should this throw be an assertion instead?  Not sure how code will continue properly if this is hit */
            return;
        }

        return parent::hasMany($related, $foreignKey, $localKey);
    }
}
