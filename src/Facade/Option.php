<?php

namespace Reallyli\Options\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string get($module, $key, $default = null)
 * @method static string set($module, $key, $value = null, $comment = null)
 * @method static string exists($module, $key)
 * @method static string remove($module, $key)
 * @method static string increase($module, $key, $step =1)
 * @method static string decrease($module, $key, $step =1)
 *
 */
class Option extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'option';
    }
}
