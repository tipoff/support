<?php

declare(strict_types=1);

namespace Tipoff\Support\Traits;

trait HasCreator
{
    protected static function bootHasCreator()
    {
        static::saving(function ($model) {
            if (auth()->check()) {
                $model->creator_id = auth()->id();
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(app('user'), 'creator_id');
    }
}
