<?php

namespace Tipoff\Support;

class Support
{
    /**
     * Resolve a service from the container.
     *
     * @param  string  $name
     * @return mixed
     */
    public static function resolve($name) {
        return app($name);
    }
}
