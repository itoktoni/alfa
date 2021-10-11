<?php

namespace Modules\System\Plugins;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang as FacadesLang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Lang
{
    public static function trans($code, $alternative = null)
    {
        $string = Str::of($code)->explode('.');
        $key = $string->first;
        $lang = Cache::forget('lang_'.$key);
        if(!Cache::has($key) && FacadesLang::has($key)){
            Cache::put('lang_'.$key, FacadesLang::get($key));
        }

        $lang = Cache::get('lang_'.$key);
        Log::info($lang);

        if(FacadesLang::has($code)){

            return trans($code);
        }

        return $alternative ?? $string->last();
    }
}
