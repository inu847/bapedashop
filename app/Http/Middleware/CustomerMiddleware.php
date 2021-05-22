<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerMiddleware
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
        if(\Auth::guard("customer")->check() == true){
            if ($request->route()->uri == 'customers/login') {
                return redirect()->back();
            }
        }else{
            return redirect()->route('login_customer');
        }
        return $next($request);
    }
}
