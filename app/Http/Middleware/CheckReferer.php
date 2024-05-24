<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckReferer
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

        $referer = $request->headers->get('referer');
        if ($referer && strpos($referer, '/verifyredirect') !== false) {
            return $next($request);
        }

        return redirect('/verifyredirect');
    }
}
