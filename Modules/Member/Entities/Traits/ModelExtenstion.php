<?php

namespace Modules\Member\Entities\Traits;

use Closure;

/**
 * 
 */

trait ModelExtenstion
{
    protected static $dynamicRelations = [];
    
    public static function registerRelation(string $name, Closure $closure)
    {
        static::$dynamicRelations[ $name ] = $closure;
    }

    public function __call($method, $variables)
    {
        if (isset(static::$dynamicRelations[ $method ])) {
            return call_user_func_array(static::$dynamicRelations[ $method ], $variables);
        }

        return parent::__call($method, $variables);
    }
}
