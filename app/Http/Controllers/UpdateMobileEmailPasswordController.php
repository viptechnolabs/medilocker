<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\Hospital;
use App\Models\User;
use App\Notifications\ChangeEmail;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function getEmailPopup(Request $request)
    {
        $id = $request->input('userId');
        $userType = $request->input('userType');
        $data = null;

        if ($userType === 'hospital') {
            $data = Hospital::findOrFail($id);
        } elseif ($userType === 'staffOrDoctor') {
            $data = User::findOrFail($id);
        }
        return view('components.update-email', ['data' => $data, 'userType' => $userType]);
    }

    public function checkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->input('id');
        $email = $request->input('email');
        $userType = $request->input('userType');
        $exists = null;

        if ($userType === 'hospital') {
            $queryBuilder = Hospital::where('email', $email);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }
            $exists = $queryBuilder->exists();
        } elseif ($userType === 'staffOrDoctor') {
            $queryBuilder = User::where('email', $email);
            if ($id) {
                $queryBuilder->where('id', '!=', $id);
            }
            $exists = $queryBuilder->exists();
            dd('staffOrDoctor', $exists);
        }

        if (!$exists) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function emailVerificationCode(Request $request)
    {
        $id = $request->input('id');
        $newEmail = $request->input('newEmail');
        $userType = $request->input('userType');

        if ($userType === 'hospital') {
            $data = Hospital::where('email', $newEmail);
            $exists = $data->exists();
            if ($exists) {
                return response()->json([
                    'message' => 'This email already registered with us.',
                    'status' => 401,
                ])->setStatusCode(401);
            } else {
                $obj = Hospital::findOrFail($id);
                $randomCode = mt_rand(11111, 99999);
                $token = Str::random(19);

                $obj->token = $token;
                $obj->verification_code = $randomCode;
                $obj->save();

                $obj->notify(new ChangeEmail($randomCode));

                return response()->json([
                    'message' => 'Ok',
                    'status' => 200,
                ])->setStatusCode(200);
            }
        }
    }

    public function updateEmail(Request $request)
    {
        $id = $request->input('id');
        $newEmail = $request->input('newEmail');
        $verificationCode = $request->input('verificationCode');
        $userType = $request->input('userType');

        if ($userType === 'hospital') {
            $hospital = Hospital::findOrFail($id);
            $databaseCode = $hospital->verification_code;
            if ($databaseCode === $verificationCode) {
                $hospital->email = $newEmail;
                $hospital->token = null;
                $hospital->verification_code = null;
                $hospital->save();

                activity('Update email')
                    ->performedOn($hospital)
                    ->log($hospital->name . ' email are update');

                return response()->json([
                    'message' => 'Ok',
                    'status' => 200,
                ])->setStatusCode(200);
            } else {
                return response()->json([
                    'message' => 'Error',
                    'status' => 400,
                ])->setStatusCode(400);
            }
        }
    }

    public function getMobilePopup()
    {
        dd('getMobilePopup');
    }
}
