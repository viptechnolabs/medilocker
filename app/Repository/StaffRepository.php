<?php

namespace App\Repository;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StaffRepository
{

    public function store($request): User
    {
        return $this->createOrUpdate($request, new User());
    }

    public function update($request, User $user): User
    {
        return $this->createOrUpdate($request, $user);
    }

    private function createOrUpdate($request, User $user): User
    {
        $newUser = empty($user->id);

        // Request params
        $hospital_id = 1;
        $user_type = 'staff';
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile_no = $request->input('mobile_no');
        $address = $request->input('address');
        $state = $request->input('state');
        $city = $request->input('city');
        $pin_code = $request->input('pin_code');
        $aadhaar_no = $request->input('aadhaar_no');
        $role = $request->input('role');
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        $avatar = $request->avatar;
        $document_pic = $request->document_pic;


        // save data
        $user->hospital_id = $hospital_id;
        $user->user_type = $user_type;
        $user->name = $name;
        $user->mobile_no = $mobile_no;
        $user->email = $email;
        $user->address = $address;
        $user->city_id = $city;
        $user->state_id = $state;
        $user->pin_code = $pin_code;
        $user->aadhaar_no = $aadhaar_no;
        $user->gender = $gender;
        $user->dob = $dob;


        if ($newUser) {
            $password = Hash::make('password');
            $user->password = $password;

            if ($avatar) {
                $destinationPath = public_path() . '/upload_file/staff/';
                $fileName = $name . '_' . $avatar->getClientOriginalName();
                $user->avatar = 'staff/' . $fileName;
                $avatar->move($destinationPath, $fileName);
            }

            if ($document_pic) {
                $destinationPath = public_path() . '/upload_file/staff/staff_document/';
                $fileName = $aadhaar_no . '_' . $document_pic->getClientOriginalName();
                $user->document_pic = $fileName;
                $document_pic->move($destinationPath, $fileName);
            }
        }

        if (!$newUser) {

            if ($avatar) {

                $destinationPath = public_path() . '/upload_file/staff/';
                $fileName = $name . '_' . $avatar->getClientOriginalName();
                $image_path = public_path("upload_file/{$user->avatar}");
                if (File::exists($image_path) && $user->avatar != null) {
                    unlink($image_path);
                }
                $avatar->move($destinationPath, $fileName);
                $user->avatar = 'staff/' . $fileName;
            }
            if ($document_pic) {
                $destinationPath = public_path() . '/upload_file/staff/staff_document';
                $fileName = $aadhaar_no . '_' . $document_pic->getClientOriginalName();
                $image_path = public_path("upload_file/staff/staff_document/{$user->document_pic}");
                if (File::exists($image_path) && $user->document_pic != null) {
                    unlink($image_path);
                }
                $document_pic->move($destinationPath, $fileName);
                $user->document_pic = $fileName;
            }
        }

        $user->save();


        $staff_id_find = Staff::orderBy('staff_id', 'DESC')->first();
        $staff_id = substr($staff_id_find->staff_id ?? 'VIP/STAFF/' . date("Y") . '/0', -1) + 1;

        if ($newUser) {
            $staff = new Staff();
            $staff->user_id = $user->id;
            $staff->staff_id = 'VIP/STAFF/' . date("Y") . '/' . $staff_id;
        }

        if (!$newUser) {
            $staff = Staff::where('user_id', $user->id)->first();
        }
        $staff->role = $role;
        $staff->save();


        if ($newUser) {
            activity('Add staff')
                ->performedOn($user)
                ->log($name . ' are added');
        } else {
            activity('Update user')
                ->performedOn($user)
                ->log($name . ' are updated');
        }

        return $user;
    }
}
