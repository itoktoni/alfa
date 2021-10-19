<?php

namespace Modules\Linen\Dao\Facades;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Facade;
use Modules\System\Plugins\Helper;

class OpnameFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Str::snake(Helper::getClass(__CLASS__));
    }
}
