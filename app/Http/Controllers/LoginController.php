<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $userType;

    public function __construct()
    {
        $this->userType = Session::get('userType');
    }

    public function login()
    {
        if (Auth::guard('hospital')->check() || Auth::guard('web')->check()) {
            return redirect()->route('index');
        } else {
            return view('login');
        }
    }

    public function doLogin(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->input('userType') === "hospital") {

            if (Auth::guard('hospital')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {

                //Authentication passed...
                activity('Login')
                    ->performedOn(Auth::guard('hospital')->user())
                    ->causedBy(Auth::guard('hospital')->user())
                    ->log(Auth::guard('hospital')->user()->name . ' Hospital login');

                Session::put('userType', 'hospital');

                return redirect()->route('index');
            }
        } elseif ($request->input('userType') === "doctor" || $request->input('userType') === "staff") {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->filled('remember'))) {

                //Authentication passed...

                if ($request->input('userType') === "doctor") {
                    activity('Doctor login')
                        ->performedOn(Auth::user())
                        ->causedBy(Auth::user())
                        ->log('Dr. ' . Auth::user()->name . ' are login');

                    Session::put('userType', 'doctor');

                } elseif ($request->input('userType') === "staff") {
                    activity('Staff login')
                        ->performedOn(Auth::user())
                        ->causedBy(Auth::user())
                        ->log(Auth::user()->name . ' are login');

                    Session::put('userType', 'staff');

                }

                return redirect()->route('index');
            }
        }

        //Authentication failed...
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');

    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        if ($this->userType === "hospital") {

            activity('Logout')
                ->performedOn(Auth::guard('hospital')->user())
                ->causedBy(Auth::guard('hospital')->user())
                ->log(Auth::guard('hospital')->user()->name . ' are logout');

            Auth::guard('hospital')->logout();

        } elseif ($this->userType === "doctor" || $this->userType === "staff") {

            if ($this->userType === "doctor") {

                activity('Doctor logout')
                    ->performedOn(Auth::user())
                    ->causedBy(Auth::user())
                    ->log('Dr. ' . Auth::user()->name . ' are logout');

            } elseif ($this->userType === "staff") {

                activity('Staff logout')
                    ->performedOn(Auth::user())
                    ->causedBy(Auth::user())
                    ->log(Auth::user()->name . ' are logout');
            }
            Auth::logout();
        }
        Session::flush();
        return redirect()
            ->route('login')
            ->with('message', 'Logout successfully...!');
    }
}
