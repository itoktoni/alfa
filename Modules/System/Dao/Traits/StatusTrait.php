<?php

namespace Modules\System\Dao\Traits;

trait StatusTrait
{
    public static function getOptions($value = false): array
    {
        $collect = collect(self::getInstances());

        if ($value && is_array($value)) 
        {
            $collect = $collect->whereIn('value', $value);
        }
        else if ($value && is_integer($value)) 
        {
            $collect = $collect->where('value', $value);
        }

        $data = [];
        foreach($collect as $item){
            $data[$item->value] = $item->description;
        }
        
        return $data;
    }

    abstract public static function colors();
    abstract public static function name();
}