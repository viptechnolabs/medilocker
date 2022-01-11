<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\User;
use App\Repository\StaffRepository;

class StaffController extends Controller
{
    private $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    public function index()
    {
        $staffs = User::where('user_type', 'staff')->get();
        return view('staff.index', ['staffs' => $staffs]);
    }

    public function addStaff()
    {
        return view('staff.addStaff');
    }

    public function storeStaff(StaffRequest $request)
    {
        $this->staffRepository->store($request);
        session()->flash('message', 'Staff add successfully...!');
        return redirect()->route('staff.index');
    }

    public function staffDetails($id)
    {
        dd('userDetails', $id);
    }

    public function staffDelete()
    {
        dd('userDelete');
    }

    public function deletedStaff()
    {
        dd('deletedUSer');
    }
}
