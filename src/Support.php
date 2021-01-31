<?php

namespace Tipoff\Support;

class Support
{
    public static function randomOrCreate($className)
    {
        if ($className::count() > 0) {
            return $className::all()->random();
        }

        return $className::factory()->create();
    }
}
