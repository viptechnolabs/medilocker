<?php

namespace App\View\Components;

use Illuminate\View\Component;

class State extends Component
{
    public $getStates;
    public $select_state;

    public function __construct($selectState)
    {
        $this->select_state = $selectState;
        $this->getStates = \App\Models\State::all();
    }

    public function render()
    {
        return view('components.state');
    }
}
