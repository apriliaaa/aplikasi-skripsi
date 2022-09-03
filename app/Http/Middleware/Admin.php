<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        // if(auth()->user()->role != 'SuperAdmin'){
        //     return redirect('/dashboard');
        // }

        // if(auth()->user()->role != 'Admin'){
        //     return redirect('/dashboard');
        // }

        // if(auth()->user()->role != 'Dosen'){
        //     return redirect('/dashboard');
        // }

        // if (auth()->user()->role === $role) {
        //     // return redirect('/dashboard');
        //     return $next($request);
        // }
        // return redirect('/dashboard');
        // return $next($request);

        if(auth()->user()->role === 'SuperAdmin' || auth()->user()->role === 'Admin'){
            // return redirect('/dashboard');
            return $next($request);
        }
        // return $next($request);
        return redirect('/dashboard');
    }

    // public function handle($request, Closure $next, ...$role)
    // {
    //     if (in_array($request->user()->role, $role)) {
    //         return $next($request);
    //     }
    //     return redirect('/');  
    // }
}
