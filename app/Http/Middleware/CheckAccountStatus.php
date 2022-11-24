<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */

    public function handle($request, Closure $next) {

        $response = $next($request);
        if(Auth::check() && Auth::user()->account_status != 'Active'){

            // force logout inactive or banned account
            //Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('message', 'Session expired! Please login again!');
        }
        return $response;
    }
}