<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $path = $request->path();
        $verified = $request->session()->get('verified');

        Log::info('Verified: ' . var_export($verified, true));

        if ($path === 'verify') {
            if ($verified !== true) {
                return redirect('/verifyredirect');
            }
        }

        return $next($request);
    }
}
