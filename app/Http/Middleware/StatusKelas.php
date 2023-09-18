<?php

namespace App\Http\Middleware;

use App\Models\Kelas;
use Closure;
use Illuminate\Http\Request;

class StatusKelas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$status)
    {
        $kelas = Kelas::where('id', $request->route('kelasku'))->firstOrFail();
        if(in_array($kelas->status,$status)){
            return $next($request);
        }
        abort(404);
    }
}
