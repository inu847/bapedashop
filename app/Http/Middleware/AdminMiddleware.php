<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if(\Auth::guard("admin")->check() == true){
            if ($request->route()->uri == 'admins/login') {
                return redirect()->back();
            }
        }else{
            return redirect()->route('login_admin');
        }
        return $next($request);
    }
}
