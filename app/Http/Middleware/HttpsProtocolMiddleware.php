<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocolMiddleware
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
        if (env('APP_ENV') === 'production') {
            if (!$request->secure()) {
                if (!!$request->input('urlback')) {
                    $urlback = str_replace('https', 'http', $request->input('urlback'));
                    return redirect()->secure(str_replace('http', 'https', $urlback));
                } else {
                    return redirect()->secure($request->getRequestUri());
                }
            }
        }

        return $next($request);
    }
}
