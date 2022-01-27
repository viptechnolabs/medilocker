<?php

namespace App\View\Components;

use Illuminate\View\Component;

class City extends Component
{
    public $cities;
    public $selected;

    public function __construct($selected = null)
    {
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.city');
    }
}
