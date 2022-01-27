<?php

namespace App\Http\Controllers;

use App\Http\Requests\HospitalRequest;
use App\Models\City;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class HospitalController extends Controller
{

    protected $hospital;

    public function __construct()
    {
        $this->hospital = Hospital::findOrFail(1);
    }

    public function index()
    {
        return view('index', ['hospital' => $this->hospital]);
    }

    public function hospitalDetails()
    {
        return view('hospitalDetails', ['hospital' => $this->hospital]);
    }

    public function profile()
    {
        if (Session::get('userType') === 'doctor') {
            dd('doctor');
        } elseif (Session::get('userType') === 'staff') {
            $staff = User::findOrFail(Auth::user()->id);
            return view('staff.staffDetails', ['staff' => $staff, 'hospital' => $this->hospital]);
        }
    }

    public function hospitalDetailsUpdate(HospitalRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Request params
        $id = $request->input('id');
        $name = $request->input('name');
        $details = $request->input('details');
        $fex_no = $request->input('fex_no');
        $pin_code = $request->input('pin_code');
        $address = $request->input('address');
        $logo = $request->logo;

        $hospital = Hospital::findOrFail(Auth::guard('hospital')->user()->id);
        $hospital->name = $name;
        $hospital->details = $details;
        $hospital->fex_no = $fex_no;
        $hospital->pin_code = $pin_code;
        $hospital->address = $address;

        if ($logo) {
            $destinationPath = public_path() . '/upload_file/';
            $fileName = $name . '_' . $logo->getClientOriginalName();
            $image_path = public_path("upload_file/{$hospital->logo}");
            if (File::exists($image_path) && $hospital->logo != null) {
                unlink($image_path);
            }
            $logo->move($destinationPath, $fileName);
            $hospital->logo = $fileName;
        }
        $hospital->save();

        activity('Hospital details update')
            ->performedOn($hospital)
            ->log($name . ' details are updated');

        session()->flash('message', 'Hospital details update successfully..!');
        return redirect()->back();
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
