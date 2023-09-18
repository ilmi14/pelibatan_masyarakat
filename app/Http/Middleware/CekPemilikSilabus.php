<?php

namespace App\Http\Middleware;

use App\Models\Silabus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekPemilikSilabus
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
        $silabus = Silabus::where('id', $request->route('silabu'))->where('user_id', Auth::user()->id)->first();
        if($silabus != null){
            return $next($request);
        } else {
            abort(404);
        }
    }
}
