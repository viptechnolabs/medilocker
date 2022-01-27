<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckUserType
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role === 'staff' && $request->url() === route('staff.staffDetailsUpdate')) {
            return $next($request);
        }
        if ($role === 'doctor' && $request->url() === route('doctorDetailsUpdate')) {
            dd($role);
            return $next($request);
        }

        Session::flush();
        Auth::logout();
        return redirect()
            ->route('login')
            ->with('error', 'You are logout because you are not allow...!');
    }
}
