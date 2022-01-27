<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChangePassword extends Component
{
    public $id;
    public $userType;

    public function __construct($id, $userType)
    {
        $this->id = $id;
        $this->userType = $userType;
    }

    public function render()
    {
        return view('components.change-password');
    }
}
