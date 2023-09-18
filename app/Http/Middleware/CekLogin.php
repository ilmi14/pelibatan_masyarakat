<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->level == 'admin') {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->level == 'tutor'){
                return redirect('tutor/dashboard');
            } elseif (Auth::user()->level == 'peserta') {
                return redirect('peserta/dashboard');
            } 
        }
        else {
            return $next($request);
        }
    }
}
