<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\Hospital;
use App\Models\User;
use App\Repository\StaffRepository;

class StaffController extends Controller
{
    protected $hospital;
    private $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->hospital = Hospital::findOrFail(1);
        $this->staffRepository = $staffRepository;
    }

    public function index()
    {
        $staffs = User::where('user_type', 'staff')->get();
        return view('staff.index', ['staffs' => $staffs, 'hospital' => $this->hospital]);
    }

    public function addStaff()
    {
        return view('staff.addStaff', ['hospital' => $this->hospital]);
    }

    public function storeStaff(StaffRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->staffRepository->store($request);
        session()->flash('message', 'Staff add successfully...!');
        return redirect()->route('staff.index');
    }

    public function staffDetails($id)
    {
        $staff = User::findOrFail($id);
        return view('staff.staffDetails', ['staff' => $staff, 'hospital' => $this->hospital]);
    }

    public function staffDetailsUpdate(StaffRequest $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->input('id');
        $user = User::findOrFail($id);

        $this->staffRepository->update($request, $user);
        session()->flash('message', 'Staff update successfully...!');
        return redirect()->back();
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
