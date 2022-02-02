<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hospital extends Authenticatable
{
    use HasFactory, Notifiable;

    public const GENDER = [
        'male' => 'Male',
        'female' => 'Female',
        'transgender' => 'Transgender',
    ];

    public const ROLE = [
        'receptionist' => 'Receptionist',
        'manager' => 'Manager',
        'accountant' => 'Accountant',
        'other' => 'Other',
    ];

    public const  USERTYPE = [
        'hospital' => 'Hospital',
        'doctor' => 'Doctor',
        'staff' => 'Staff',
    ];
}
