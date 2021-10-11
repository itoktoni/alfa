<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // $action_code = request()->route()->getName() ?? false;
        // $action_function = request()->route()->getActionMethod() ?? false;
        // if ($action_function != 'data') {
        //     if (Cache::has('cache_' . $action_code)) {
        //         $html = Cache::get('cache_' . $action_code);
        //         $response->setContent($html);
        //         return $response;
        //     }
        // }

        $html = $response->getContent();
        if (strpos($html, '<pre>') !== false) {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\r/"                      => '',
                "/>\n</"                    => '><',
                "/>\s+\n</"                 => '><',
                "/>\n\s+</"                 => '><',
            );
        } else {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/"                  => '<?php ',
                "/\n([\S])/"                => '$1',
                "/\r/"                      => '',
                "/\n/"                      => '',
                "/\t/"                      => '',
                "/ +/"                      => ' ',
            );
        }
        $html = preg_replace(array_keys($replace), array_values($replace), $html);
        // if($action_function != 'data'){
        //     Cache::put('cache_' . $action_code, $html, 5);
        // }
        $response->setContent($html);
        return $response;
    }
}
