<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;

if (! function_exists('randomOrCreate')) {
    /**
     * Ger random model or create model using factory.
     *
     * @param  string|Model $classNameOrModel
     * @return Model
     */
    function randomOrCreate($classNameOrModel): Model
    {
        if (is_string($classNameOrModel)) {
            $className = $classNameOrModel;
        }

        if ($classNameOrModel instanceof Model) {
            $className = class_basename($classNameOrModel);
        }

        if ($className::count() > 0) {
            return $className::all()->random();
        }

        return $className::factory()->create();
    }
}
