<?php

namespace Tipoff\Support;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tipoff\Support\Support
 */
class SupportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'support';
    }
}
