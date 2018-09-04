<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAuthor
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
        if(\Auth::user() == null) {
            return redirect()->route('index');
            if (\Auth::user()->user_type != 2) {
                return redirect()->route('index');
            }
        }
        
        return $next($request);
    }
}
