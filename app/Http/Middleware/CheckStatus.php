<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('hospital')->check()) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->status === 'active') {
            return $next($request);
        }

        Session::flush();
        Auth::logout();
        return redirect()
            ->route('login')
            ->with('error', 'You are logout because you are not allow...!');
    }
}
