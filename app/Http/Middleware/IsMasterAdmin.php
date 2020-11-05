<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsMasterAdmin
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
        $user= Auth::user();



        if (!$user->ismasteradmin()) {

            return redirect()->intended('/attendance');
        }

        return $next($request);
    }
}
