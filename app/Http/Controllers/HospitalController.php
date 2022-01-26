<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HospitalController extends Controller
{

    public function index()
    {
        $hospital = Hospital::findOrFail(1);
        return view('index', ['hospital' => $hospital]);
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
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'], $request->filled('remember'))) {

                //Authentication passed...

                if ($request->input('userType') === "doctor") {
                    activity('Doctor login')
                        ->performedOn(Auth::guard('web')->user())
                        ->causedBy(Auth::guard('web')->user())
                        ->log('Dr. ' . Auth::guard('web')->user()->name . ' are login');

                    Session::put('userType', 'doctor');

                } elseif ($request->input('userType') === "staff") {
                    activity('Staff login')
                        ->performedOn(Auth::guard('web')->user())
                        ->causedBy(Auth::guard('web')->user())
                        ->log(Auth::guard('web')->user()->name . ' are     login');

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
        if (Session::get('userType') === "hospital") {

            activity('Logout')
                ->performedOn(Auth::guard('hospital')->user())
                ->causedBy(Auth::guard('hospital')->user())
                ->log(Auth::guard('hospital')->user()->name . ' are logout');

            Auth::guard('hospital')->logout();

        } elseif (Session::get('userType') === "doctor" || Session::get('userType') === "staff") {

            if (Session::get('userType') === "doctor") {

                activity('Doctor logout')
                    ->performedOn(Auth::guard('doctor')->user())
                    ->causedBy(Auth::guard('doctor')->user())
                    ->log('Dr. ' . Auth::guard('doctor')->user()->name . ' are logout');

                Auth::guard('doctor')->logout();

            } elseif (Session::get('userType') === "staff") {

                activity('User logout')
                    ->performedOn(Auth::guard('web')->user())
                    ->causedBy(Auth::guard('web')->user())
                    ->log(Auth::guard('web')->user()->name . ' are logout');

                Auth::logout();

            }
        }
        Session::flush();
        return redirect()
            ->route('login')
            ->with('message', 'Logout successfully...!');
    }

    public function fetchCities(Request $request): string
    {
        $cities = City::where("state_id", $request->stateId)->get();
        return view('components.city', [
            'cities' => $cities,
            'selected' => $request->selected
        ])->render();
    }
}
