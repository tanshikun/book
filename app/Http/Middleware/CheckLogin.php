<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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

        $http_referer = $_SERVER['HTTP_REFERER'];//通过这个php的内置方法获取上一次访问的地址


        $member = $request->session()->get('member','');//通过request方法获取session  当没获取到member的时候 取一个空字符串
        if($member==''){
            return redirect('/login?return_url='.urlencode($http_referer));//将上一次的参数  传到这个路径中来 ，用urlencode包起来 urlencode：对url路径进行加密处理
        }
        return $next($request);
    }
}

