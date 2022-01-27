<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateMobileEmailPasswordController extends Controller
{
    public function checkPassword(Request $request)
    {
        # Request params
        $password = $request->input('currentPassword');
        if (Auth::guard('hospital')->check()) {
            if (Hash::check($password, Auth::guard('hospital')->user()->password)) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } elseif (Auth::check()) {
            if (Hash::check($password, Auth::user()->password)) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }
    }

    public function changePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->input('id');
        $userType = $request->input('userType');
        $password = $request->input('password');

        if (Auth::guard('hospital')->check()) {
            if ($userType === 'hospital') {
                $hospital = Hospital::findOrFail(Auth::guard('hospital')->user()->id);
                $hospital->password = Hash::make($password);
                $hospital->save();
            } elseif ($userType === 'staffOrDoctor') {
                $user = User::findOrFail($id);
                $user->password = Hash::make($password);
                $user->save();
            }
        } elseif (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($password);
            $user->save();
        }
        session()->flash('message', 'Password Change Successfully..!');
        return redirect()->back();
    }
}
