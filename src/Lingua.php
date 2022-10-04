<?php

namespace alessandrobelli\Lingua;

use Illuminate\Support\Facades\Facade;

/**
 * @see \alessandrobelli\Lingua\LinguaUtilities
 */
class Lingua extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'lingua';
    }
}
