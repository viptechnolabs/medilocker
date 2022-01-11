<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    public function fetchCities(Request $request): string
    {
        $cities = City::where("state_id", $request->stateId)->get();
        return view('components.city', [
            'cities' => $cities,
            'selected' => $request->selected
        ])->render();
    }
}
