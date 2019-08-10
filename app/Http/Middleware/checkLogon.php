<?php

namespace App\Http\Middleware;

use Closure;

class checkLogon
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
        if (session()->has('username') == false) {
            return redirect('/');
        }
        if (session('change_password_at') == null) {
            return redirect('password/change');
        }
        return $next($request);
    }
}
