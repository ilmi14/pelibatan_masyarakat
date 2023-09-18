<?php

namespace App\Http\Middleware;

use App\Models\RegistrasiKelas;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRegistrasi
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
        $registrasi = RegistrasiKelas::where('kelas_id', $request->route('kelasku'))->where('user_id', Auth::user()->id)->first();
        if($registrasi != null){
            if ($registrasi->status == 'Diterima') {
                return $next($request);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
