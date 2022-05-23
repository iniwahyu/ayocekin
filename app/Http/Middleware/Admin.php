<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->get('role') != '1'){
            return redirect()->to('/bunker/login')->with('error', 'Mohon Untuk Login Terlebih dahulu');
        }
        return $next($request);
    }
}
