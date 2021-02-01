<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;

if (!function_exists ( 'randomOrCreate' )) {
    function randomOrCreate(string $className): Model
    {
        if ($className::count() > 0) {
            return $className::all()->random();
        }

        return $className::factory()->create();
    }
}
