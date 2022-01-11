<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

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
}
