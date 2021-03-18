<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Browser;

class CheckBrowser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (class_exists(Browser::class)) {
            if (Browser::isChrome() || Browser::isSafari() || (Browser::browserFamily()=="Coc Coc")) {
                return $next($request);
            } else {
                return response()->view('errors.noitice',[
                    'title' => 'Trình duyệt không được hỗ trợ',
                    'error_code' => ':v',
                    'error_description' => 'Không hỗ trợ trình duyệt này',
                    'text_xlarge' => 'Vui lòng sử dụng Chrome hoặc Safari để tiếp tục truy cập',
                ]);
            }
        } else {
            return $next($request);
        }
    }
}
