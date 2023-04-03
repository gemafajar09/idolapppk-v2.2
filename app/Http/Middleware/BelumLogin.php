<?php

namespace App\Http\Middleware;

use Closure;

class BelumLogin
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
        if (!session()->has('id_pengguna')) {
            return $next($request);
        } else {
            return redirect()->route('frontend.index')->with("success", "Selamat Datang!!!");;
        }
    }
}