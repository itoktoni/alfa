<?php

namespace Modules\System\Dao\Traits;

trait StatusTrait
{
    public static function getOptions($value = false): array
    {
        $collect = collect(self::getInstances());
        if (is_array($value)) 
        {
            $collect = $collect->whereIn('value', $value);
        }
        
        $collect = $collect->pluck('value', 'description')->flip();
        
        if (self::name()) 
        {
            $collect = $collect->prepend('- Select ' . self::name() . ' -', '');
        }
        
        return $collect->toArray();
    }

    abstract public static function colors();
    abstract public static function name();
}